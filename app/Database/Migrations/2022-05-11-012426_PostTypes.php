<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostType extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_post_type' => [
                'type' => 'INT',
                'constraint' => 6,
                'auto_increment' => true
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['Artikel', 'Idea'],
                'default' => 'Artikel'
            ],
        ]);
        $this->forge->addKey('id_post_type', true);
        $this->forge->createTable('post_types');
    }

    public function down()
    {
        $this->forge->dropTable('post_types');
    }
}
