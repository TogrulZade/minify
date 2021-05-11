<?php

namespace minify;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = array();
    protected $table = 'products';

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'product_id','id');
    }

}
