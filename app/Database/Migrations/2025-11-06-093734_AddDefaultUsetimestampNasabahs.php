<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddDefaultUsetimestampNasabahs extends Migration
{
    public function up()
    {
        $fields = [
            'created_at' => [
                'type' => 'DATETIME',
                'DEFAULT' => new RawSql('NOW()')
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'DEFAULT' => new RawSql('NOW()')
            ],
        ];
        $this->forge->dropColumn('nasabahs', ['created_at', 'updated_at']);
        $this->forge->addColumn('nasabahs', $fields);
    }

    public function down()
    {

        $fields = [
            "created_at" => [
                "type" => "DATETIME",
            ],
            "updated_at" => [
                "type" => "DATETIME",
            ],
        ];
        $this->forge->dropColumn('nasabahs', ['created_at', 'updated_at']);
        $this->forge->addColumn('nasabahs', $fields);
    }
}
