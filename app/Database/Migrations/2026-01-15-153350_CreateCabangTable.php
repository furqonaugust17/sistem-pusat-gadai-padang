<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateBranchTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'TYPE'           => 'UUID',
                'DEFAULT'   => new RawSql('uuid_generate_v4()')
            ],
            'nama_cabang' => [
                'TYPE'       => 'VARCHAR',
                'CONSTRAINT'    => 100
            ],
            'alamat_cabang' => [
                'TYPE'       => 'VARCHAR',
                'CONSTRAINT'    => 255
            ],
            'link_google_maps' => [
                'TYPE'       => 'VARCHAR',
                'CONSTRAINT'    => 255
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
        $this->forge->createTable('cabangs');
    }

    public function down()
    {
        $this->forge->dropTable('cabangs');
    }
}
