<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            [
                'name' => 'Smartphones',
                'code' => 'mobiles',
                'description' => 'Most popular and powerful smartphones',
            ],
            [
                'name' => 'Portable',
                'code' => 'portable',
                'description' => 'All of that - from earphones to GoPro',
            ],
            [
                'name' => 'Appliances',
                'code' => 'appliance',
                'description' => 'Cool appliance for your house',
            ],
        ]);
    }
}
