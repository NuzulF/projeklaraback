<?php

namespace Database\Seeders;

use App\Models\Paket as ModelsPaket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Paket extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paket = [
            [
                'nama_paket' => 'Paket 1.1',
                'harga_paket' => 15000,
                'destinasi_id' => 1,
                'jenis' => 'wahana'
            ],
            [
                'nama_paket' => 'Paket 1.2',
                'harga_paket' => 13000,
                'destinasi_id' => 1,
                'jenis' => 'wahana'
            ],
            [
                'nama_paket' => 'Paket 3',
                'harga_paket' => 8000,
            ],
            [
                'nama_paket' => 'Paket d1',
                'harga_paket' => 50000,
                'jenis' => 'destinasi'
            ],
            [
                'nama_paket' => 'Paket d2',
                'harga_paket' => 45000,
                'jenis' => 'destinasi'
            ],
            [
                'nama_paket' => 'Paket d3',
                'harga_paket' => 40000,
                'jenis' => 'destinasi'
            ],
            [
                'nama_paket' => 'Paket 2.1',
                'harga_paket' => 10000,
                'destinasi_id' => 2,
                'jenis' => 'wahana'
            ],
            [
                'nama_paket' => 'Paket 2.2',
                'harga_paket' => 11000,
                'destinasi_id' => 2,
                'jenis' => 'wahana'
            ],
        ];

        foreach ($paket as $key => $value) {
            ModelsPaket::create($value);
        }
    }
}
