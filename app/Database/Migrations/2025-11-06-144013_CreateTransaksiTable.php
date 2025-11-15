<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'TYPE'           => 'UUID',
                'DEFAULT'   => new RawSql('uuid_generate_v4()')
            ],
            'nasabah_id' => [
                'TYPE'       => 'UUID',
            ],
            'barang_id' => [
                'TYPE'       => 'UUID',
            ],
            'karyawan_id' => [
                'TYPE'       => 'UUID',
            ],
            'kode' => [
                'TYPE'       => 'VARCHAR',
                'CONSTRAINT'    => 100,
                'UNIQUE'     => true,
            ],
            'nama_kontak_darurat' => [
                'TYPE'       => 'VARCHAR',
                'CONSTRAINT'    => 100
            ],
            'no_kontak_darurat' => [
                'TYPE'       => 'VARCHAR',
                'CONSTRAINT'    => 20
            ],
            'nominal' => [
                'TYPE'  => 'BIGINT',
            ],
            'jatuh_tempo' => [
                'TYPE' => 'DATETIME',
            ],
            'status' => [
                'TYPE' => 'status_transaksi',
                'DEFAULT' => 'Gadai'
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
        $this->forge->addForeignKey('nasabah_id', 'nasabahs', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->addForeignKey('barang_id', 'barang_gadais', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->addForeignKey('karyawan_id', 'karyawans', 'id', 'NO ACTION', 'CASCADE');

        $this->forge->createTable('transaksis');
    }

    public function down()
    {
        $this->forge->dropTable('transaksis');
    }
}
