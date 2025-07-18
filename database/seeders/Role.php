<?php

namespace Database\Seeders;

use App\Models\Role as ModelsRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nama_role' => 'Super Admin',
            ],
            [
                'nama_role' => 'Admin Kabupaten',
            ],
            [
                'nama_role' => 'Admin Desa',
            ],
            [
                'nama_role' => 'Admin Wisata',
            ],
            [
                'nama_role' => 'User',
            ]
        ];

        foreach ($user as $key => $value) {
            ModelsRole::create($value);
        }
    }
}
