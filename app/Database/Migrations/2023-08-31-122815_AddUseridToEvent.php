<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUseridToEvent extends Migration
{
    public function up()
    {
        $this->forge->addColumn('event', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true
            ]
        ]);
    
        $sql = "ALTER TABLE event
                ADD CONSTRAINT event_user_id_fk
                FOREIGN KEY (user_id) REFERENCES user(id)
                ON DELETE CASCADE ON UPDATE CASCADE";
    
        $this->db->simpleQuery($sql);
    }

    public function down()
    {
        $this->forge->dropForeginKey('event', 'event_user_id_fk');
        $this->forge->dropColumn('event', 'user_id');
    }
}
