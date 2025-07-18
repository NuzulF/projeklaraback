<?php

namespace Database\Seeders;

use App\Models\Wahana as ModelsWahana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Wahana extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wahana = [
            // hutan pinus nongko ijo
            [
                'nama_wahana' => 'Wahana 1.1',
                'foto_wahana' => '168431244445.jpg|168431325740.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '1',
                'deskripsi_wahana' => 'deskripsi',
            ],
            [
                'nama_wahana' => 'Wahana 1.2',
                'foto_wahana' => '168431244445.jpg|168431325740.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '1',
                'deskripsi_wahana' => 'deskripsi',
            ],
            [
                'nama_wahana' => 'Wahana 1.3',
                'foto_wahana' => '168431244445.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '1',
                'deskripsi_wahana' => 'deskripsi',
            ],
            [
                'nama_wahana' => 'Wahana 1.4',
                'foto_wahana' => '168431244445.jpg|168431325740.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '1',
                'deskripsi_wahana' => 'deskripsi',
            ],
            [
                'nama_wahana' => 'Wahana 1.5',
                'foto_wahana' => '168431244445.jpg|168431325740.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '1',
                'deskripsi_wahana' => 'deskripsi',
            ],
            // air terjun selampir
            [
                'nama_wahana' => 'Wahana 2.1',
                'foto_wahana' => '168431244445.jpg|168431325740.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '2',
                'deskripsi_wahana' => 'deskripsi',
            ],
            [
                'nama_wahana' => 'Wahana 2.2',
                'foto_wahana' => '168431244445.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '2',
                'deskripsi_wahana' => 'deskripsi',
            ],
            [
                'nama_wahana' => 'Wahana 2.3',
                'foto_wahana' => '168431244445.jpg|168431325740.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '2',
                'deskripsi_wahana' => 'deskripsi',
            ],
            [
                'nama_wahana' => 'Wahana 2.4',
                'foto_wahana' => '168431244445.jpg|168431325740.jpg',
                'htm_wahana' => '10000',
                'destinasi_id' => '2',
                'deskripsi_wahana' => 'deskripsi',
            ],
        ];

        foreach ($wahana as $key => $value) {
            ModelsWahana::create($value);
        }
    }
}
