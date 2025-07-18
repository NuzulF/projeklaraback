<?php

namespace Database\Seeders;

use App\Models\ProfilKabupaten as ModelsProfilKabupaten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilKabupaten extends Seeder
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
                'nama_kabupaten' => 'Kabupaten Madiun',
                'admin_id' => '2',
                'foto_kabupaten' => 'kabMadiun.png',
                'province_id' => '35',
                'regency_id' => '3519',
            ],
            [
                'nama_kabupaten' => 'Kabupaten Pekalongan',
                'admin_id' => '3',
                'foto_kabupaten' => 'kabPekalongan.png',
                'province_id' => '33',
                'regency_id' => '3326',
            ],
            [
                'nama_kabupaten' => 'Kota Semarang',
                'admin_id' => '4',
                'foto_kabupaten' => 'kotaSemarang.png',
                'province_id' => '33',
                'regency_id' => '3374',
            ],
            [
                'nama_kabupaten' => 'Kota Surakarta',
                'admin_id' => '5',
                'foto_kabupaten' => 'kotaSurakarta.png',
                'province_id' => '33',
                'regency_id' => '3372',
            ],
        ];

        foreach ($user as $key => $value) {
            ModelsProfilKabupaten::create($value);
        }
    }
}
