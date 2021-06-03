<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use minify\Product;
use minify\Picture;
use Faker\Generator as Faker;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($k = 1; $k<=10;$k++){
        $pr = new Product();
        
        $pr->product_name = $faker->word;
        $pr->product_description = $faker->paragraph(3);
        $pr->product_price = $faker->randomFloat(2, 0, 10000);
        $pr->product_merchant = $faker->word;
        $pr->merchant_number = "055".rand(4000000,5999999);
        $pr->product_category = rand(1,9);
        $pr->slug = rand(0,200000);
        $pr->created_at = '2021-05-31 18:14:13';
        $pr->updated_at = '2021-05-31 18:14:13';
        $pr->uniqid = uniqid();
        $pr->product_cover = "products/".$faker->image('public/storage/products/',640,480, null, false);

        for($i = 0; $i<=5; $i++){
            $pc = new Picture();
            $pc->url = "products/".$faker->image('public/storage/products/',640,480, null, false);
            $pc->cover_photo = "products/cover/".$faker->image('public/storage/products/cover/',640,480, null, false);
            $pc->uniqid = $pr->uniqid;
            if($i == 0)$pc->cover = 1;else $pc->cover = 0;
            $pc->save();
        }

        $pr->save();
    }
    }
}