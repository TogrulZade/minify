<?php

namespace minify;

use Illuminate\Database\Eloquent\Model;

class Fav extends Model
{
    protected $table = 'favs';

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id')->leftjoin('pictures','pictures.product_id','products.id');
    }
    
}
