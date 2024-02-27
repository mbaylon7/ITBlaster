<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectAdmin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pa_projectid' => [
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

            'pa_status_flag' => [
                'type' => 'INT',
                'constraint' => 3,
                'default'   => 0
            ]
        ]);
        $this->forge->addField('created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->forge->addKey('pa_projectid', true);
        $this->forge->createTable('tbl_project_admin');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_project_admin');
    }
}
