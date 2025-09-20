<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNullToNasabahColumns extends Migration
{
    public function up()
    {
        $field = [
            'no_telp2' => [
                'null' => true
            ],
            'email' => [
                'null' => true
            ],
        ];
        $this->forge->modifyColumn('nasabahs', $field);
    }

    public function down()
    {
        $field = [
            'no_telp2' => [
                'null' => false
            ],
            'email' => [
                'null' => false
            ],
        ];
        $this->forge->modifyColumn('nasabahs', $field);
    }
}
