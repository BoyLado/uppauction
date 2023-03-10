<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBidderRegitrations extends Migration
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
            'bidder_id'             => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'auction_id'            => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'auction_date'          => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'auth_code'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'confirmed'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'confirmed_date'        => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'created_date'          => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bidder_registrations');
    }

    public function down()
    {
        $this->forge->dropTable('bidder_registrations');
    }
}
