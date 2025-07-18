<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IndoRegionSeeder::class);
        $this->call(Role::class);
        $this->call(Kategori::class);
        $this->call(StatusKeranjang::class);
        $this->call(Destinasi::class);
        $this->call(Paket::class);
        $this->call(PaketDestinasi::class);
        $this->call(JenisPembayaran::class);
        $this->call(Admin::class);
        $this->call(ProfilKabupaten::class);
        $this->call(ProfilDesa::class);
        $this->call(Wahana::class);
        $this->call(PaketWahana::class);
        $this->call(Banner::class);
        $this->call(JenisAduan::class);
    }
}
