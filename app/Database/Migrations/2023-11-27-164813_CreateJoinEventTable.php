<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJoineventTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 9,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'event_id' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => 20,
                'collation' => 'utf8mb3_general_ci',
            ],
            'phone' => [
                'type' => 'varchar',
                'constraint' => 20,
                'collation' => 'utf8mb3_general_ci',
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 20,
                'collation' => 'utf8mb3_general_ci',
            ],
            'occupation' => [
                'type' => 'varchar',
                'constraint' => 20,
                'collation' => 'utf8mb3_general_ci',
                'null' => true,
            ],
            'reason' => [
                'type' => 'varchar',
                'constraint' => 64,
                'collation' => 'utf8mb3_general_ci',
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('joinevent');

        // Copy data from volunteer table to joinevent table
        $this->db->query('INSERT INTO joinevent (event_id, name, phone, email, occupation, reason, created_at, updated_at) SELECT event_id, name, phone, email, occupation, reason, created_at, updated_at FROM volunteer');
    }

    public function down()
    {
        $this->forge->dropTable('joinevent');
    }
}