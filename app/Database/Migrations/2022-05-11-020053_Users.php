<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 6,
                'auto_increment' => true
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
