<?php

namespace App\Services;

use App\Models\BarangFileModel;
use App\Models\BarangGadaiModel;
use App\Models\CabangModel;
use App\Models\NasabahModel;
use App\Models\TransaksiModel;
use App\Services\SendMessageService;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\I18n\Time;

class TransaksiService
{
    protected $transaksiModel;
    protected $nasabahModel;
    protected $barangFileModel;
    protected $nasabahService;
    protected $barangService;
    protected $sendMessageService;
    protected $barangGadaiModel;
    protected $cabangModel;
    protected $db;

    public function __construct()
    {

        $this->transaksiModel = new TransaksiModel();
        $this->nasabahModel = new NasabahModel();
        $this->barangFileModel = new BarangFileModel();
        $this->nasabahService = new NasabahService();
        $this->barangService  = new BarangService();
        $this->sendMessageService  = new SendMessageService();
        $this->barangGadaiModel = new BarangGadaiModel();
        $this->cabangModel = new CabangModel();
        $this->db = \Config\Database::connect();
    }

    public function create(array $data, $files, $karyawan_id)
    {
        $this->db->transBegin();

        try {

            $nasabah = $this->nasabahService->getOrCreate($data);
            $barang_id = $this->barangService->createBarang($data, $files);

            $transaksi = $this->createTransaksi($nasabah['id'], $barang_id, $data, $karyawan_id);

            $this->db->transCommit();

            $message = $this->sendMessageService->templateNewTransaction([
                'nama_nasabah'      => isset($data['nama_lengkap']) ? $data['nama_lengkap'] : $nasabah['nama_lengkap'],
                'kode'              => $transaksi['kode'],
                'nama_barang'       => $data['nama_barang'],
                'jenis_barang'      => $data['jenis'],
                'jumlah_pinjaman'   => number_format($data['nominal'], 0, ',', '.'),
                'tanggal_transaksi' => $transaksi['created_at'],
                'jatuh_tempo'       => $data['jatuh_tempo'],
            ]);

            $this->sendMessageService->sendMessage($nasabah['no_wa'], $message, $transaksi['id']);
            return $transaksi['id'];
        } catch (\Exception $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    protected function createTransaksi($nasabah_id, $barang_id, $data, $karyawan_id)
    {
        $nasabah = explode('-', $nasabah_id)[1];
        $kode = $this->generateKodeTransaksi(strtoupper($nasabah));

        $transaksiID = $this->transaksiModel->insert([
            'nasabah_id' => $nasabah_id,
            'barang_id' => $barang_id,
            'karyawan_id' => $karyawan_id,
            'kode' => $kode,
            'nama_kontak_darurat' => $data['nama_kontak_darurat'],
            'no_kontak_darurat' => $data['no_kontak_darurat'],
            'nominal' => $data['nominal'],
            'jatuh_tempo' => $data['jatuh_tempo'],
            'status' => 'Gadai',
            'tujuan' => $data['tujuan'],
            'detail_tujuan' => $data['detail_tujuan'] ?? null,
            'cabang_id' => $data['detail_tujuan'] ?? $this->cabangModel->select('id')->like('LOWER(nama_cabang)', 'utama')->first(),
            'kode_trans' => $data['kode_trans'] ?? null
        ]);

        $transaksi = $this->transaksiModel->select('created_at')->find($transaksiID);
        return [
            'id'            => $transaksiID,
            'kode'          => $kode,
            'created_at'    => $transaksi['created_at']
        ];
    }

    public function generateKodeTransaksi($nasabah_id)
    {
        $prefix = "UGM";
        $datePart = date("ym");

        $month = date("m");
        $year  = date("Y");

        $count = $this->transaksiModel
            ->where('EXTRACT(MONTH FROM created_at)', $month)
            ->where('EXTRACT(YEAR FROM created_at)', $year)
            ->countAllResults();

        $seq = str_pad($count + 1, 4, "0", STR_PAD_LEFT);

        return "{$prefix}-{$nasabah_id}-{$datePart}-{$seq}";
    }

    public function updateStatus($id)
    {
        $transaksi = $this->transaksiModel->select('barang_id')->find($id);

        if (!$transaksi) {
            throw new \RuntimeException('Data transaksi tidak ditemukan.');
        }

        $this->db->transStart();

        try {
            $this->transaksiModel->update($id, ['status' => 'Lelang']);
            $this->barangGadaiModel->update($transaksi['barang_id'], ['status' => 'Lelang']);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new DatabaseException('Gagal menyimpan perubahan ke database.');
            }

            return true;
        } catch (\Exception $e) {
            $this->db->transRollback();
            throw $e;
        }
    }

    public function datatable($orderBy, $orderDir, $start, $length, $search, $draw)
    {
        $builder = $this->transaksiModel
            ->select("transaksis.id, transaksis.kode, transaksis.kode_trans, nasabahs.nama_lengkap as nasabah, transaksis.nominal, transaksis.jatuh_tempo, transaksis.status")
            ->join("nasabahs", "nasabahs.id = transaksis.nasabah_id");


        if ($search) {
            $searchLower = strtolower($search);

            $builder->groupStart()
                ->like('LOWER(transaksis.kode)', $searchLower)
                ->orLike('LOWER(transaksis.kode_trans)', $searchLower)
                ->orLike('LOWER(nasabahs.nama_lengkap)', $searchLower)
                ->orWhere("LOWER(CAST(transaksis.nominal AS TEXT)) LIKE ", "%{$searchLower}%", null, false)
                ->orWhere("LOWER(CAST(transaksis.status AS TEXT)) LIKE ", "%{$searchLower}%", null, false)
                ->orWhere("LOWER(TO_CHAR(transaksis.jatuh_tempo, 'DD Month YYYY')) LIKE ", "%{$searchLower}%", null, false)
                ->groupEnd();
        }


        $recordsTotal = $builder->countAllResults(false);


        $builder->orderBy($orderBy, $orderDir)
            ->limit($length, $start);

        $rows = $builder->get()->getResultArray();


        foreach ($rows as &$r) {
            $r['nominal']       = number_format($r['nominal'], 0, ',', '.');
            $r['jatuh_tempo']   = Time::parse($r['jatuh_tempo'])
                ->toLocalizedString('dd MMMM yyyy');
            $r['status'] = match ($r['status']) {
                'Gadai' => '<span class="badge bg-warning text-dark">Gadai</span>',
                'Lelang' => '<span class="badge bg-danger">Lelang</span>',
                'Jatuh Tempo' => '<span class="badge bg-danger">Jatuh Tempo</span>',
                'Lunas' => '<span class="badge bg-success">Lunas</span>'
            };
        }

        return [
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsTotal,
            "data"            => $rows
        ];
    }

    public function detail($id)
    {
        $transaksi = $this->transaksiModel->getData($id);

        if (!$transaksi) {
            throw new \Exception("Data transaksi tidak ditemukan");
        }
        $barangFiles = $this->barangFileModel->getFiles($transaksi['barang_id']);

        $transaksi['files'] = $barangFiles;

        return $transaksi;
    }

    public function detailByKode($kode)
    {
        $transaksi = $this->transaksiModel->getData(kode: $kode);

        if (!$transaksi) {
            throw new \Exception("Data transaksi tidak ditemukan");
        }
        $barangFiles = $this->barangFileModel->getFiles($transaksi['barang_id']);

        $transaksi['files'] = $barangFiles;

        return $transaksi;
    }
}
