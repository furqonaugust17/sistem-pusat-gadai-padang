<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateBarangFilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'UUID',
                'DEFAULT'   => new RawSql('uuid_generate_v4()')
            ],
            'barang_id' => [
                'type'       => 'UUID',
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'DEFAULT' => new RawSql('NOW()')
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'DEFAULT' => new RawSql('NOW()')
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('barang_id', 'barang_gadais', 'id', 'NO ACTION', 'CASCADE');

        $this->forge->createTable('barang_files');
    }

    public function down()
    {
        $this->forge->dropTable('barang_files');
    }
}
