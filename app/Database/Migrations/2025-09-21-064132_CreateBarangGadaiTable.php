<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateBarangGadaiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'TYPE'  => 'UUID',
                'DEFAULT'   => new RawSql('uuid_generate_v4()')
            ],
            'tipe' => [
                'TYPE'  => 'jenis_barang'
            ],
            'nama_barang' => [
                'TYPE'  => 'VARCHAR',
                'CONSTRAINT' => 100
            ],
            'deskripsi' => [
                'TYPE'  => 'TEXT',
            ],
            'nilai_taksiran' => [
                'TYPE'  => 'BIGINT',
            ],
            'status' => [
                'TYPE'  => 'status_barang'
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
        $this->forge->createTable('barang_gadais', true);
    }

    public function down()
    {
        $this->forge->dropTable('barang_gadais', true);
    }
}
