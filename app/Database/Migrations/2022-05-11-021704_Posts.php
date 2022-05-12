<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Posts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_post' => [
                'type' => 'INT',
                'constraint' => 6,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 600,
            ],
            'post_type' => [
                'type' => 'INT',
                'constraint' => 6,
            ],
            'user' => [
                'type' => 'INT',
                'constraint' => 6,
            ]
        ]);
        $this->forge->addKey('id_post', true);
        $this->forge->addForeignKey('post_type', 'post_types', 'id_post_type');
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable();
    }
}
