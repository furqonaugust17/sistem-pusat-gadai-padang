<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeleteFileGambarBarang extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('barang_kendaraans', 'file_gambar');
        $this->forge->dropColumn('barang_elektroniks', 'file_gambar');
    }

    public function down()
    {

        $this->forge->addColumn('barang_kendaraans', [
            'file_gambar'    => [
                'TYPE'  => 'VARCHAR',
                'CONSTRAINT' => 255,
                'after' => 'bpkb'
            ],
        ]);
        $this->forge->addColumn('barang_elektroniks', [
            'file_gambar'    => [
                'TYPE'  => 'VARCHAR',
                'CONSTRAINT' => 255,
                'after' => 'tahun_pembuatan'
            ],
        ]);
    }
}
