<?php

namespace Database\Seeders;

use App\Models\Kategori as ModelsKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Kategori extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            [
                'nama_kategori' => 'Alam',
                'icon' => 'fas fa-tree',
                'deskripsi' => 'Wisata alam memberikan pengalaman yang luar biasa bagi pengunjung yang mencari keindahan dan ketenangan di lingkungan alami dengan destinasi yang mempesona.'
            ],
            [
                'nama_kategori' => 'Buatan',
                'icon' => 'fas fa-building',
                'deskripsi' => 'destinasi wisata yang dibuat atau dikembangkan oleh manusia untuk menarik pengunjung dengan membangun atraksi dan fasilitas yang menarik di area yang telah diproses atau dibangun secara khusus.'
            ],
        ];

        foreach ($kategori as $key => $value) {
            ModelsKategori::create($value);
        }
    }
}
