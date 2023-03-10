<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserLogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'user_id'               => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'log_title'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'log_details'       => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'created_date'          => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_logs');
    }

    public function down()
    {
        $this->forge->dropTable('user_logs');
    }
}
