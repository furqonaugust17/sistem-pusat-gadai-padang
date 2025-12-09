<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPekerjaanToNasabah extends Migration
{
    public function up()
    {
        $fields = [
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ];
        $this->forge->addColumn('nasabahs', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('nasabahs', ['pekerjaan']);
    }
}
