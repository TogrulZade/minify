<?php

use Illuminate\Database\Seeder;

class product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('products')->insert([
            'product_name' => Str::random(10),
            'product_description' => Str::random(10),
            'product_price' => Str::random(10),
            'slug' => Str::random(10),
        ]);
    }
}
