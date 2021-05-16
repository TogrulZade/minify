<?php

namespace minify;

use Illuminate\Database\Eloquent\Model;

class SeenProduct extends Model
{
    protected $table = 'seen_products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id','anonim'
    ];
    
    
}
