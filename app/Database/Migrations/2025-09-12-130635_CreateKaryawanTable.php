<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateKaryawanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "UUID",
                "default" => new RawSql('uuid_generate_v4()')
            ],
            "user_id" => [
                "type" => "UUID",
            ],
            "nama" => [
                "type" => "VARCHAR",
                "constraint" => 100,
            ],
            "jenis_kelamin" => [
                "type" => "gender",
            ],
            "no_telp" => [
                "type" => "VARCHAR",
                "constraint" => 20,
            ],
            "alamat" => [
                "type" => "TEXT",
            ],
            "created_at" => [
                "type" => "DATETIME",
            ],
            "updated_at" => [
                "type" => "DATETIME",
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->createTable('karyawans', true);
    }

    public function down()
    {
        $this->forge->dropTable('karyawans', true);
    }
}
