<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUserTable extends Migration
{
    public function up()
    {
        // Delete the 'name' column
        $this->forge->dropColumn('user', 'name');

        // Add new columns
        $this->forge->addColumn('user', [
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null'       => true
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null'       => true
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null'       => true
            ],
        ]);
    }

    public function down()
    {
        $this->forge->addColumn('user', [
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null'       => true
            ],
        ]);

        $this->forge->dropColumn('user', ['phone_number', 'first_name', 'last_name']);
    }
}
