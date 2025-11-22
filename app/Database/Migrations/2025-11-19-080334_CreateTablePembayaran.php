<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTablePembayaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'TYPE'           => 'UUID',
                'DEFAULT'   => new RawSql('uuid_generate_v4()')
            ],
            'transaksi_id' => [
                'TYPE'       => 'UUID',
            ],
            'total_bayar' => [
                'TYPE'       => 'BIGINT',
            ],
            'tanggal_bayar' => [
                'TYPE' => 'DATETIME',
                'DEFAULT' => new RawSql('NOW()')
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

        $this->forge->createTable('pembayarans');
    }

    public function down()
    {
        $this->forge->dropTable('pembayarans');
    }
}
