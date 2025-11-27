<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogPesansEnum extends Migration
{
    public function up()
    {
        $this->db->query("CREATE TYPE log_pesan_status AS ENUM('berhasil', 'gagal')");
    }

    public function down()
    {
        $this->db->query('DROP TYPE log_pesan_status');
    }
}
