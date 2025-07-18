<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketWahana extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paket1 = Paket::find(1);
        $paket2 = Paket::find(2);

        $paket1->wahana()->attach(1);
        $paket1->wahana()->attach(2);
        $paket1->wahana()->attach(3);

        $paket2->wahana()->attach(2);
        $paket2->wahana()->attach(4);

        $paket7 = Paket::find(7);
        $paket8 = Paket::find(8);

        $paket7->wahana()->attach(6);
        $paket7->wahana()->attach(7);

        $paket8->wahana()->attach(6);
        $paket8->wahana()->attach(7);
    }
}
