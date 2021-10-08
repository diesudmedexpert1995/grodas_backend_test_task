<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'name' => 'Samsung Galaxy S21 256GB',
                'code' => 'samsung_galaxy_s21_256gb',
                'description' => 'Beauty of technology',
                'price' => '26990',
                'category_id' => 1,
            ],
            [
                'name' => 'Apple iPhone 11 256GB',
                'code' => 'apple_iphone_x_256gb',
                'description' => 'Good present for apple lovers',
                'price' => '19990',
                'category_id' => 1,
            ],
            [
                'name' => 'Earphones Sony XB700',
                'code' => 'sony_xb_700',
                'description' => 'Magic power of wireless',
                'price' => '5600',
                'category_id' => 2,
            ],
            [
                'name' => 'GoPro Hero 7',
                'code' => 'gopro_hero_7',
                'description' => 'Capture the colorful moments of your life',
                'price' => '12000',
                'category_id' => 2,

            ],
            [
                'name' => 'Freedge Beko RCNA4070',
                'code' => 'beko_rcna_4070',
                'description' => 'Big family. Big fridge',
                'price' => '11990',
                'category_id' => 3,
            ],
            [
                'name' => 'Meat mincer Moulinex',
                'code' => 'bosch',
                'description' => 'Tasty dishes for gourmet',
                'price' => '3559',
                'category_id' => 3,
            ],
        ]);
    }
}
