<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropColumnInNasabahTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('nasabahs', ['nama_kontak_darurat', 'no_kontak_darurat']);
    }

    public function down()
    {
        $this->forge->addColumn('nasabahs', [
            'nama_kontak_darurat'    => [
                'TYPE' => 'TEXT',
            ],
            'no_kontak_darurat'    => [
                'TYPE' => 'VARCHAR',
                'CONSTRAINT' => 20
            ],
        ]);
    }
}
