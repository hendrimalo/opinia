<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_post'       => 201,
                'title'         => 'Mobil Tesla',
                'description'   => 'Lorem ipsum',
                'post_type'     => 102,
                'user'          => 'hendrimalo',
            ],
            [
                'id_post'       => 202,
                'title'         => 'Mobil Jeep',
                'description'   => 'Test kedua',
                'post_type'     => 101,
                'user'          => 'putrip',
            ],
        ];
        $this->db->table('posts')->insertBatch($data);
    }
}
