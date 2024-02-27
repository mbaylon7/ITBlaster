<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Applicant extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'applicantid' => [
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

            'application_status' => [
                'type' => 'INT',
                'constraint' => 3,
                'default'   => 0
            ]
        ]);
        $this->forge->addField('created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->forge->addKey('applicantid', true);
        $this->forge->createTable('tbl_applicant');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_applicant');
    }
}
