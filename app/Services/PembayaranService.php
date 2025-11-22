<?php

namespace App\Services;

use App\Models\BarangFileModel;
use App\Models\BarangGadaiModel;
use App\Models\PembayaranModel;
use App\Models\TransaksiModel;

class PembayaranService
{
    protected $pembayaranModel;
    protected $transaksiModel;
    protected $barangGadaiModel;
    protected $barangFileModel;
    protected $db;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->transaksiModel = new TransaksiModel();
        $this->barangGadaiModel = new BarangGadaiModel();
        $this->barangFileModel = new BarangFileModel();
        $this->db = \Config\Database::connect();
    }

    public function create(array $data)
    {
        $this->db->transBegin();

        try {

            $transaksiId = $data['transaksi_id'] ?? null;

            $transaksi = $this->transaksiModel
                ->select('id, nominal, barang_id')
                ->where('id', $transaksiId)
                ->first();

            if (!$transaksi) {
                throw new \Exception('Data transaksi tidak ditemukan');
            }

            $totalBayar = $transaksi['nominal'];

            $payload = [
                'transaksi_id' => $transaksiId,
                'total_bayar'  => $totalBayar,
            ];

            $this->pembayaranModel->insert($payload);
            $this->transaksiModel->update($transaksiId, ['status' => 'Lunas']);
            if (!empty($transaksi['barang_id'])) {
                $this->barangGadaiModel
                    ->update($transaksi['barang_id'], ['status' => 'Lunas']);
            }
            $pembayaranId = $this->pembayaranModel->getInsertID();

            $this->db->transCommit();

            return $pembayaranId;
        } catch (\Exception $e) {
            $this->db->transRollback();
            throw $e;
        }
    }


    public function datatable($orderBy, $orderDir, $start, $length, $search, $draw)
    {
        $builder = $this->pembayaranModel
            ->select("pembayarans.id, transaksis.kode, nasabahs.nama_lengkap as nasabah, pembayarans.tanggal_bayar, pembayarans.total_bayar")
            ->join("transaksis", "transaksis.id = pembayarans.transaksi_id")
            ->join("nasabahs", "nasabahs.id = transaksis.nasabah_id");


        if ($search) {
            $searchLower = strtolower($search);

            $builder->groupStart()
                ->like('LOWER(transaksis.kode)', $searchLower)
                ->orLike('LOWER(nasabahs.nama_lengkap)', $searchLower)
                ->orWhere("LOWER(CAST(pembayarans.total_bayar AS TEXT)) LIKE ", "%{$searchLower}%", null, false)
                ->orWhere("LOWER(TO_CHAR(pembayarans.tanggal_bayar, 'DD Month YYYY')) LIKE ", "%{$searchLower}%", null, false)
                ->groupEnd();
        }


        $recordsTotal = $builder->countAllResults(false);


        $builder->orderBy($orderBy, $orderDir)
            ->limit($length, $start);

        $rows = $builder->get()->getResultArray();


        foreach ($rows as &$r) {
            $r['total_bayar']       = number_format($r['total_bayar'], 0, ',', '.');
            $r['tanggal_bayar']   = date('d F Y', strtotime($r['tanggal_bayar']));
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

        $pembayaran = $this->pembayaranModel->getData($id);

        if (!$pembayaran) {
            throw new \Exception("Data pembayaran tidak ditemukan");
        }


        $files = $this->barangFileModel->getFiles($pembayaran['barang_id']);


        return [
            'pembayaran'  => [
                'id'           => $pembayaran['id'],
                'tanggal'      => $pembayaran['tanggal_bayar'],
                'total_bayar'  => $pembayaran['total_bayar']
            ],

            'transaksi'   => [
                'kode'         => $pembayaran['kode'],
                'nominal'      => $pembayaran['nominal'],
                'jatuh_tempo'  => $pembayaran['jatuh_tempo'],
                'status'       => $pembayaran['status'],
                'nama_kontak_darurat'   => $pembayaran['nama_kontak_darurat'],
                'no_kontak_darurat'     => $pembayaran['no_kontak_darurat'],
            ],

            'nasabah'     => [
                'nama_lengkap'         => $pembayaran['nama_lengkap'],
                'nasabah_telp1'         => $pembayaran['nasabah_telp1'],
                'nasabah_wa'           => $pembayaran['nasabah_wa'],
                'nasabah_alamat'       => $pembayaran['nasabah_alamat'],
            ],

            'karyawan'    => [
                'nama'         => $pembayaran['karyawan_nama']
            ],

            'files'       => $files
        ];
    }
}
