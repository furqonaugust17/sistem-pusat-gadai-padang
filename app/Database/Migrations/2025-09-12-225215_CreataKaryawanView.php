<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreataKaryawanView extends Migration
{
    public function up()
    {
        $this->db->query("
        CREATE OR REPLACE VIEW view_karyawan AS
SELECT
    k.id,
    k.nama,
    k.no_telp,
    g.group AS jabatan,
    a.secret AS email,
    CASE 
        WHEN k.jenis_kelamin = 'L' THEN 'Laki-laki'
        WHEN k.jenis_kelamin = 'P' THEN 'Perempuan'
    END AS jenis_kelamin,
    k.alamat
FROM karyawans k
INNER JOIN users u ON k.user_id = u.id
LEFT JOIN auth_groups_users g ON u.id = g.user_id
INNER JOIN auth_identities a ON u.id = a.user_id;
        ");
    }

    public function down()
    {
        $this->db->query("DROP VIEW IF EXISTS view_karyawan;");
    }
}
