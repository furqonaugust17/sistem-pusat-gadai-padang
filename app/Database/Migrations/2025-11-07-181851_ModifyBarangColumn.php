<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyBarangColumn extends Migration
{
    public function up()
    {
        $fields = [
            'tipe' => [
                'NAME' => 'jenis',
                'TYPE'  => 'jenis_barang'
            ],
        ];
        $this->forge->modifyColumn('barang_gadais', $fields);
    }

    public function down()
    {
        $fields = [
            'jenis' => [
                'NAME' => 'tipe',
                'TYPE'  => 'jenis_barang'
            ],
        ];
        $this->forge->modifyColumn('barang_gadais', $fields);
    }
}
