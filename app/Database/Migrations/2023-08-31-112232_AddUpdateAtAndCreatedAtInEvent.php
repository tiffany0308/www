<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpdateAtAndCreatedAtInEvent extends Migration
{
    public function up()
    {
        $this->forge->addColumn('event', [
            'created_at' => [
                'type'     => 'DATETIME',
                'null'     => true,
                'default'  => null
            ],
            'updated_at' => [
                'type'     => 'DATETIME',
                'null'     => true,
                'default'  => null
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('event', 'updated_at');
        $this->forge->dropColumn('event', 'created_at');
    }
}
