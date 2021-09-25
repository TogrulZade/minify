<?php

use Illuminate\Database\Seeder;
use minify\Category;
use minify\Subcategory;

class subCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub = new Subcategory();

        $sub->category = 2;
        $sub->order = 3;
        $sub->sub_name = 'Audio və video';
        $sub->save();
    }
}
