<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_post_type'  => 101,
                'jenis'         => 'Opini',
                'type'          => 'Artikel',
            ],
            [
                'id_post_type'  => 102,
                'jenis'         => 'Cerpen',
                'type'          => 'Artikel',
            ],
            [
                'id_post_type'  => 103,
                'jenis'         => 'Idea',
                'type'          => 'Idea',
            ],
            [
                'id_post_type'  => 104,
                'jenis'         => 'Esai',
                'type'          => 'Artikel',
            ],  
        ];
        $this->db->table('post_types')->insertBatch($data);
    }
}
