<?php

namespace Database\Seeders;

use App\Models\Banner as ModelsBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Banner extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = [
            [
                'gambar' => 'Banner1.png|Banner2.png|Banner3.png',
            ]
        ];

        foreach ($banner as $key => $value) {
            ModelsBanner::create($value);
        }
    }
}
