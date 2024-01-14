<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEventTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
            ],
            'description' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
            ],
            'day_of_week' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20', 
            ],
            'start_time' => [
                'type'           => 'TIME', 
            ],
            'end_time' => [
                'type'           => 'TIME' 
            ],
            'location' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
            ],
            'organizer' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
            ],
            'contact_number' => [
                'type'           => 'VARCHAR',
                'constraint'     => '128',
            ],
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

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('event');
    }

    public function down()
    {
        $this->forge->dropTable('event');
    }
}
