<?php

namespace minify;

use Illuminate\Database\Eloquent\Model;
use minify\Product;

class Picture extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'uniqid','uniqid');
    }
}
