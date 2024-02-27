<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Comment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'commentid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'clientid' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],

            'projectid' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],

            'ticketid' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],

            'itid' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],

            'comment_content' => [
                'type' => 'TEXT',
                'null' => true
            ],

            'comment_status_flag' => [
                'type' => 'INT',
                'constraint' => 3,
                'default'   => 0
            ]
        ]);
        $this->forge->addField('created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->forge->addKey('commentid', true);
        $this->forge->createTable('tbl_comment');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_comment');
    }
}
