<?php

namespace App\Models;


class LogPesanModel extends CustomModel
{
    protected $table            = 'log_pesans';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'transaksi_id',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;

    public function datatable()
    {
        $builder = $this->select('transaksis.kode, nasabahs.nama_lengkap, nasabahs.no_wa, log_pesans.created_at, log_pesans.status')
            ->join('transaksis', 'log_pesans.transaksi_id = transaksis.id', 'INNER')
            ->join('nasabahs', 'transaksis.nasabah_id = nasabahs.id', 'INNER');

        return $builder;
    }
}
