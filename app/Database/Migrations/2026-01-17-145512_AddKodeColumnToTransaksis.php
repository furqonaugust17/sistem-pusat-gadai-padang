<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKodeColumnToTransaksis extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksis', [
            'kode_trans' => [
                'type' => 'VARCHAR',
                'CONSTRAINT'    => 100,
                'after' => 'kode',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaksis', ['kode_trans']);
    }
}
