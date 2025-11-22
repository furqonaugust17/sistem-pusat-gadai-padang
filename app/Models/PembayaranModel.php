<?php

namespace App\Models;

class PembayaranModel extends CustomModel
{
    protected $table            = 'pembayarans';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'transaksi_id',
        'total_bayar',
        'tanggal_bayar',
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

    public function getData($id = null)
    {
        $data = $this->select(
            'pembayarans.id,
             pembayarans.transaksi_id,
             pembayarans.total_bayar,
             pembayarans.tanggal_bayar,

             transaksis.kode,
             transaksis.nominal,
             transaksis.jatuh_tempo,
             transaksis.status,
             transaksis.barang_id,
             transaksis.nama_kontak_darurat,
             transaksis.no_kontak_darurat,

             nasabahs.nama_lengkap,
             nasabahs.no_telp1 AS nasabah_telp1,
             nasabahs.no_wa AS nasabah_wa,
             nasabahs.alamat_domisili AS nasabah_alamat,

             karyawans.nama AS karyawan_nama'
        )
            ->join('transaksis', 'transaksis.id = pembayarans.transaksi_id', 'INNER')
            ->join('nasabahs', 'nasabahs.id = transaksis.nasabah_id', 'INNER')
            ->join('karyawans', 'karyawans.id = transaksis.karyawan_id', 'INNER');

        if ($id) {
            return $data->find($id);
        }

        return $data->findAll();
    }
}
