<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreatePerpanjangsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'UUID',
                'DEFAULT'   => new RawSql('uuid_generate_v4()')
            ],
            'transaksi_id' => [
                'type' => 'UUID',
            ],
            'interval_days' => [
                'TYPE'  => 'INTEGER',
            ],
            'nominal' => [
                'TYPE'  => 'BIGINT',
            ],
            'created_at' => [
                'TYPE' => 'DATETIME',
                'DEFAULT' => new RawSql('NOW()')
            ],
            'updated_at' => [
                'TYPE' => 'DATETIME',
                'DEFAULT' => new RawSql('NOW()')
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('transaksi_id', 'transaksis', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->createTable('perpanjangs');
    }

    public function down()
    {
        $this->forge->dropTable('perpanjangs');
    }
}
