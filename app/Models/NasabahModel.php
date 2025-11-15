<?php

namespace App\Models;

class NasabahModel extends CustomModel
{
    protected $table            = 'nasabahs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_lengkap',
        'panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat_ktp',
        'alamat_domisili',
        'no_telp1',
        'no_telp2',
        'no_wa',
        'email'
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


    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['addId'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function Datatables()
    {
        $data = $this->select('
        id AS id, 
        nama_lengkap AS nama,
        no_telp1 AS no_telp,
        email AS email,
        lower(jenis_kelamin::text) AS jenis_kelamin,
        alamat_domisili as alamat 
        ', false);

        return $data;
    }
}
