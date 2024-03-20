<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'iphone 15',
                'product_type' => 1,
                'price' => 59000,
                'created_at' => Carbon::now()
            ],
            [
                'product_name' => 'LG smart tv',
                'product_type' => 2,
                'price' => 30000,
                'created_at' => Carbon::now()
            ],
            [
                'product_name' => 'samsung s30',
                'product_type' => 1,
                'price' => 45000,
                'created_at' => Carbon::now()
            ],
            [
                'product_name' => 'apple Tv',
                'product_type' => 1,
                'price' => 3000,
                'created_at' => Carbon::now()
            ],

        ]);

    }
}
