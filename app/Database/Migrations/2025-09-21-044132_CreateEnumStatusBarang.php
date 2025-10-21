<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnumStatusBarang extends Migration
{
    public function up()
    {
        $this->db->query("CREATE TYPE status_barang AS ENUM('Gadai', 'Jatuh Tempo', 'Lunas', 'Lelang', 'Terlelang')");
    }

    public function down()
    {
        $this->db->query('DROP TYPE status_barang');
    }
}
