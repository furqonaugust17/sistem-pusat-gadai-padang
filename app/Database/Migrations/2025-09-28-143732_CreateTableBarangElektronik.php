<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableBarangElektronik extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'TYPE'  => 'UUID',
                'DEFAULT'   => new RawSql('uuid_generate_v4()')
            ],
            'barang_id'    => [
                'TYPE'  => 'UUID',
            ],
            'merk'    => [
                'TYPE'  => 'VARCHAR',
                'CONSTRAINT' => 100,
            ],
            'tipe'    => [
                'TYPE'  => 'VARCHAR',
                'CONSTRAINT' => 100,
            ],
            'tahun_pembuatan'    => [
                'TYPE'  => 'INTEGER',
                'CONSTRAINT' => 5,
            ],
            'file_gambar'    => [
                'TYPE'  => 'VARCHAR',
                'CONSTRAINT' => 255,
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
        $this->forge->addForeignKey('barang_id', 'barang_gadais', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->createTable('barang_elektroniks', true);
    }

    public function down()
    {
        $this->forge->dropTable('barang_elektroniks', true);
    }
}
