<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateNasabahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'TYPE' => 'UUID',
                'DEFAULT' => new RawSql('uuid_generate_v4()')
            ],
            'nama_lengkap'    => [
                'TYPE' => 'TEXT',
            ],
            'panggilan'    => [
                'TYPE' => 'VARCHAR',
                'CONSTRAINT' => 50
            ],
            'tempat_lahir'    => [
                'TYPE' => 'TEXT',
            ],
            'tanggal_lahir'    => [
                'TYPE' => 'DATE',
            ],
            'jenis_kelamin'    => [
                'TYPE' => 'gender',
            ],
            'alamat_ktp'    => [
                'TYPE' => 'TEXT',
            ],
            'alamat_domisili'    => [
                'TYPE' => 'TEXT',
            ],
            'no_telp1'    => [
                'TYPE' => 'VARCHAR',
                'CONSTRAINT' => 20
            ],
            'no_telp2'    => [
                'TYPE' => 'VARCHAR',
                'CONSTRAINT' => 20
            ],
            'no_wa'    => [
                'TYPE' => 'VARCHAR',
                'CONSTRAINT' => 20
            ],
            'nama_kontak_darurat'    => [
                'TYPE' => 'TEXT',
            ],
            'no_kontak_darurat'    => [
                'TYPE' => 'VARCHAR',
                'CONSTRAINT' => 20
            ],
            'email'    => [
                'TYPE' => 'TEXT',
            ],
            "created_at" => [
                "type" => "DATETIME",
            ],
            "updated_at" => [
                "type" => "DATETIME",
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('nasabahs', true);
    }

    public function down()
    {
        $this->forge->dropTable('nasabahs', true);
    }
}
