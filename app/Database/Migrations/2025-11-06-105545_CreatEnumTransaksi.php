<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatEnumTransaksi extends Migration
{
    public function up()
    {
        $this->db->query("CREATE TYPE status_transaksi AS ENUM('Gadai', 'Jatuh Tempo', 'Lunas', 'Lelang')");
    }

    public function down()
    {
        $this->db->query('DROP TYPE status_transaksi');
    }
}
