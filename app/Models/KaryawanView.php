<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanView extends Model
{
    protected $table            = 'view_karyawan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'no_telp', 'jabatan', 'email', 'jenis_kelamin', 'alamat'];
}
