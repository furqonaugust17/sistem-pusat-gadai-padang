<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnumTypeBarang extends Migration
{
    public function up()
    {
        $this->db->query("CREATE TYPE jenis_barang AS ENUM('Kendaraan', 'Elektronik', 'Lainnya')");
    }

    public function down()
    {
        $this->db->query('DROP TYPE jenis_barang');
    }
}
