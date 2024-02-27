<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Log extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'logid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'userid' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],

            'action_activity' => [
                'type' => 'TEXT',
                'null' => true
            ]

        ]);
        $this->forge->addField('created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->forge->addKey('logid', true);
        $this->forge->createTable('tbl_logs');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_logs');
    }
}
