<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CheckUUIDFunction extends Migration
{
    public function up()
    {
        $this->db->query('CREATE EXTENSION IF NOT EXISTS "uuid-ossp"');
    }

    public function down()
    {
        $this->db->query('DROP EXTENSION "uuid-ossp"');
    }
}
