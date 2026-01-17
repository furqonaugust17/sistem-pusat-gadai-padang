<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCabangColumnToTransaksis extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksis', [
            'cabang_id' => [
                'type' => 'UUID',
                'after' => 'id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaksis', ['cabang_id']);
    }
}
