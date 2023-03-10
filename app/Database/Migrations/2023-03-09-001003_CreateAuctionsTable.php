<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuctionsTable extends Migration
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
            'auction_title'         => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'auction_description'   => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'auction_date'          => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'status'                => [
                'type'              => 'ENUM',
                'constraint'        => ['1','0'],
                'null'              => true,
            ],
            'created_by'            => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'created_date'          => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_by'        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'updated_date'      => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auctions');
    }

    public function down()
    {
        $this->forge->dropTable('auctions');
    }
}
