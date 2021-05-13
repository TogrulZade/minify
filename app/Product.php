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

    public function city(){
        return $this->hasOne(City::class, 'id',"city_id");
    }

    public function market(){
        return $this->hasOne(market::class, 'id',"market_id");
    }

}
