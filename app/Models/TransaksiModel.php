<?php

namespace App\Models;

class TransaksiModel extends CustomModel
{
    protected $table            = 'transaksis';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nasabah_id',
        'barang_id',
        'karyawan_id',
        'kode',
        'nama_kontak_darurat',
        'no_kontak_darurat',
        'nominal',
        'jatuh_tempo',
        'status',
        'tujuan',
        'detail_tujuan',
        'cabang_id',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function Datatables()
    {
        $data = $this->select("
        transaksis.kode as kode,
        nasabahs.nama_lengkap as nasabah,
        CAST(transaksis.nominal AS TEXT) AS nominal,
        CAST(transaksis.status AS TEXT) as status,
        transaksis.jatuh_tempo as jatuh_tempo
        ", false)
            ->join('nasabahs', 'transaksis.nasabah_id = nasabahs.id', 'INNER');

        return $data;
    }

    public function getData($id = null, $kode = null)
    {
        $data = $this->select("
            transaksis.id,
            transaksis.kode,
            transaksis.barang_id,
            transaksis.nominal,
            transaksis.jatuh_tempo,
            transaksis.nama_kontak_darurat,
            transaksis.no_kontak_darurat,
            transaksis.status,
            nasabahs.nama_lengkap,
            nasabahs.no_telp1,
            nasabahs.no_wa,
            nasabahs.alamat_domisili,
            cabangs.nama_cabang,
        ")
            ->join('nasabahs', 'transaksis.nasabah_id = nasabahs.id', 'INNER')
            ->join('cabangs', 'transaksis.cabang_id = cabangs.id', 'INNER');

        if (!$id && !$kode) {
            return $data->findAll();
        } else if ($id && !$kode) {
            return $data->find($id);
        } else if (!$id && $kode) {
            return $data->where('kode', $kode)->first();
        }
    }

    public function search($query)
    {
        $lowerCase = strtolower($query);
        $data = $this->select('transaksis.id, transaksis.kode, nasabahs.nama_lengkap, transaksis.nominal')
            ->join('nasabahs', 'transaksis.nasabah_id = nasabahs.id', 'INNER')
            ->like('LOWER(transaksis.kode)', $lowerCase)
            ->orLike('LOWER(nasabahs.nama_lengkap)', $lowerCase)->findAll(20);

        return $data;
    }

    public function getReminderList()
    {
        return $this->select("
            transaksis.id,
            transaksis.kode,
            transaksis.jatuh_tempo,
            nasabahs.nama_lengkap AS nama_nasabah,
            nasabahs.no_wa
        ")
            ->join('nasabahs', 'nasabahs.id = transaksis.nasabah_id')
            ->where('transaksis.status', 'Gadai')
            ->where("DATE(transaksis.jatuh_tempo) >= CURRENT_DATE")
            ->where("DATE(transaksis.jatuh_tempo) <= CURRENT_DATE + INTERVAL '3 days'")
            ->orderBy('transaksis.jatuh_tempo', 'ASC')
            ->findAll();
    }

    public function transaksiBulanan()
    {
        $query = $this
            ->select("EXTRACT(MONTH FROM created_at) as bulan, COUNT(*) as jumlah_transaksi, SUM(nominal) as total_nominal")->where('EXTRACT(YEAR FROM created_at)', date('Y'))
            ->groupBy("EXTRACT(MONTH FROM created_at)")
            ->orderBy("bulan", "ASC")
            ->get()
            ->getResultArray();

        $bulanData = array_fill(0, 12, ['jumlah' => 0, 'nominal' => 0]);

        foreach ($query as $row) {
            $index = (int)$row['bulan'] - 1;
            $bulanData[$index] = [
                'jumlah' => (int)$row['jumlah_transaksi'],
                'nominal' => (float)$row['total_nominal']
            ];
        }

        $response = [
            'jumlah_transaksi' => array_map(fn($b) => $b['jumlah'], $bulanData),
            'total_nominal' => array_map(fn($b) => $b['nominal'], $bulanData),
        ];

        return $response;
    }
}
