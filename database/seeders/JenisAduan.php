<?php

namespace Database\Seeders;

use App\Models\JenisAduan as ModelsJenisAduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisAduan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisAduan = [
            [
                'nama' => 'Reschedule',
                'status' => true,
            ]
        ];

        foreach ($jenisAduan as $key => $value) {
            ModelsJenisAduan::create($value);
        }
    }
}
