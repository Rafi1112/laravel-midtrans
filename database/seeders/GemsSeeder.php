<?php

namespace Database\Seeders;

use App\Models\Gem;
use Illuminate\Database\Seeder;

class GemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gems = [
            [
                'title' => '20 Gems - Rp. 20.000,-',
                'amount_gems' => 20,
                'price_gems' => 20000,
                'description' => 'Contains 20 Gems',
            ],
            [
                'title' => '55 Gems - Rp. 50.000,-',
                'amount_gems' => 55,
                'price_gems' => 50000,
                'description' => 'Contains 55 Gems',
            ],
            [
                'title' => '120 Gems - Rp. 100.000,-',
                'amount_gems' => 120,
                'price_gems' => 100000,
                'description' => 'Contains 120 Gems',
            ],
            [
                'title' => '180 Gems - Rp. 150.000,-',
                'amount_gems' => 180,
                'price_gems' => 150000,
                'description' => 'Contains 180 Gems',
            ],
            [
                'title' => '245 Gems - Rp. 200.000,-',
                'amount_gems' => 245,
                'price_gems' => 200000,
                'description' => 'Contains 245 Gems',
            ],
            [
                'title' => '370 Gems - Rp. 300.000,-',
                'amount_gems' => 370,
                'price_gems' => 300000,
                'description' => 'Contains 370 Gems',
            ],
            [
                'title' => '500 Gems - Rp. 400.000,-',
                'amount_gems' => 500,
                'price_gems' => 400000,
                'description' => 'Contains 500 Gems',
            ],
            [
                'title' => '750 Gems - Rp. 500.000,-',
                'amount_gems' => 750,
                'price_gems' => 500000,
                'description' => 'Contains 750 Gems',
            ],
            [
                'title' => '1650 Gems - Rp. 1.000.000,-',
                'amount_gems' => 1650,
                'price_gems' => 1000000,
                'description' => 'Contains 1650 Gems',
            ],
            [
                'title' => '3500 Gems - Rp. 2.000.000,-',
                'amount_gems' => 3500,
                'price_gems' => 2000000,
                'description' => 'Contains 3500 Gems',
            ],
            [
                'title' => '3900 Gems - Rp. 3.000.000,-',
                'amount_gems' => 3900,
                'price_gems' => 3000000,
                'description' => 'Contains 3900 Gems',
            ],
            [
                'title' => '6500 Gems - Rp. 5.000.000,- | Super Deals',
                'amount_gems' => 6500,
                'price_gems' => 5000000,
                'description' => 'Contains 6500 Gems',
            ],
            [
                'title' => '15000 Gems - Rp. 10.000.000,- | Hype Deals',
                'amount_gems' => 15000,
                'price_gems' => 10000000,
                'description' => 'Contains 15000 Gems',
            ],
        ];

        foreach ( $gems as $gem ) {
            Gem::create($gem);
        }
    }
}
