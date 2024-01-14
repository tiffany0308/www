<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddApprovalToEvent extends Migration
{
    public function up()
    {
        $this->forge->addColumn('event', [
            'approval' => [
                'type'    => 'BOOLEAN',
                'null'    => false,
                'default' => false
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('event', 'approval');
    }
}
