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

    public function getData($id)
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
        ")
            ->join('nasabahs', 'transaksis.nasabah_id = nasabahs.id', 'INNER')
            ->find($id);

        return $data;
    }
}
