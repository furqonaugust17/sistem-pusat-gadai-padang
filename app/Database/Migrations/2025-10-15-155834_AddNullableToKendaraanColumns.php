<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNullableToKendaraanColumns extends Migration
{
    public function up()
    {
        $fields = [
            'stnk' => [
                'TYPE'  => 'VARCHAR',
                'CONSTRAINT' => 255,
                'null'       => true,
            ],
            'bpkb' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ];
        $this->forge->modifyColumn('barang_kendaraans', $fields);
    }

    public function down()
    {
        $fields = [
            'stnk' => [
                'TYPE'  => 'VARCHAR',
                'CONSTRAINT' => 255,
                'null'       => false,
            ],
            'bpkb' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ];
        $this->forge->modifyColumn('barang_kendaraans', $fields);
    }
}
