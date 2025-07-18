<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKeranjang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'status' => 'Belum checkout'
            ],
            [
                'status' => 'Sudah checkout, belum bayar'
            ],
            [
                'status' => 'Sudah bayar'
            ],
        ];

        foreach ($status as $key => $value) {
            \App\Models\StatusKeranjang::create($value);
        }
    }
}
