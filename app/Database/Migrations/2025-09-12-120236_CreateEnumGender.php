<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnumGender extends Migration
{
    public function up()
    {
        $this->db->query("CREATE TYPE gender AS ENUM('Laki-Laki', 'Perempuan')");
    }

    public function down()
    {
        $this->db->query('DROP TYPE gender');
    }
}
