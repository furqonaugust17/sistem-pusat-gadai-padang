<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTujuanFieldToTransaksi extends Migration
{
    public function up()
    {
        $fields = [
            'tujuan' => [
                'type' => 'VARCHAR',
                'after' => 'status',
                'constraint' => 20,
            ],
            'detail_tujuan' => [
                'type' => 'VARCHAR',
                'after' => 'tujuan',
                'constraint' => 100,
                'null' => true
            ],
        ];
        $this->forge->addColumn('transaksis', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaksis', ['tujuan', 'detail_tujuan']);
    }
}
