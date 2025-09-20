<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawans';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'jenis_kelamin', 'no_telp', 'alamat', 'user_id'];

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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getKaryawan($id = null)
    {
        $data = $this->select("
        karyawans.id as id,
        karyawans.nama as nama,
        users.username as username,
        karyawans.no_telp as no_telp,
        auth_groups_users.group as jabatan,
        auth_identities.secret as email,
        CAST(karyawans.jenis_kelamin AS TEXT) as jenis_kelamin,
        karyawans.alamat as alamat")
            ->join('users', 'karyawans.user_id = users.id', 'INNER')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id', 'LEFT')
            ->join('auth_identities', 'users.id = auth_identities.user_id', 'INNER');

        if ($id != null) {
            return $data->find($id);
        } else {
            return $data->findAll();
        }
    }

    public function Datatables()
    {
        $data = $this->select("
        karyawans.id as id,
        karyawans.nama as nama,
        users.username as username,
        karyawans.no_telp as no_telp,
        auth_groups_users.group as jabatan,
        auth_identities.secret as email,
        lower(jenis_kelamin::text) AS jenis_kelamin,
        karyawans.alamat as alamat", false)
            ->join('users', 'karyawans.user_id = users.id', 'INNER')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id', 'LEFT')
            ->join('auth_identities', 'users.id = auth_identities.user_id', 'INNER');

        return $data;
    }

    public function getUserId($id)
    {
        $data = $this->find($id);
        return $data['user_id'];
    }
}
