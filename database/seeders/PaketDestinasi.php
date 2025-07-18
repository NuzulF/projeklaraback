<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketDestinasi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paket1 = Paket::find(4);
        $paket2 = Paket::find(5);

        $paket1->destinasi()->attach(1);
        $paket1->destinasi()->attach(2);
        $paket1->destinasi()->attach(3);

        $paket2->destinasi()->attach(2);
        $paket2->destinasi()->attach(4);
    }
}
