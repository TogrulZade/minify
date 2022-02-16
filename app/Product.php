<?php

namespace minify;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = array();
    protected $table = 'products';

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'uniqid','uniqid');
    }

    public function market()
    {
        return $this->hasOne(market::class, 'id','market_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id','product_category');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id',"city_id");
    }


    public function vip()
    {
        return $this->hasMany(Vip::class, 'product_id',"id")->where('vip.closed_at',">",date('Y-m-d H:i:s'));
    }

    public function ireli()
    {
        return $this->hasMany(ireli::class, 'product_id',"id")
        ->where('ireli.closed_at',">",date('Y-m-d H:i:s'))
        ->orderBy("ireli.started_at","DESC");
    }

    public function premium()
    {
        return $this->hasMany(Premium::class, 'product_id',"id")->where('premium.closed_at',">",date('Y-m-d H:i:s'));
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'product_id','id');
    }

    public function favs()
    {
        return $this->hasMany(Fav::class, 'product_id','id');
    }
}
