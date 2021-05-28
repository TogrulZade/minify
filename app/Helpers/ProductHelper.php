<?php 

namespace minify\Helpers;
use minify\Product;

class ProductHelper{
    
    public static function getAllProduct()
    {
        $all = Product::all();
        print_r($all);      
    }
}

?>