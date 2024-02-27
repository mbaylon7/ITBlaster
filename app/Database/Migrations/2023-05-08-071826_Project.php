<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Project extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'projectid' => [
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

            'itid' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],

            'project_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false
            ],

            'description' => [
                'type' => 'LONGTEXT',
                'null' => true
            ],

            'desired_timeline' => [
                'type' => 'TEXT',
                'null' => true
            ],

            'allot_skills' => [
                'type' => 'TEXT',
                'null' => true
            ],

            'project_label' => [
                'type' => 'VARCHAR',
                'constraint' =>100,
                'null' => true
            ],

            'project_status_flag' => [
                'type' => 'INT',
                'constraint' => 3,
                'default'   => 0
            ]

        ]);
        $this->forge->addField('created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->forge->addKey('projectid', true);
        $this->forge->createTable('tbl_project');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_project');
    }
}
