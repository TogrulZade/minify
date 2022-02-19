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

    /**
     * The products that belong to the SeenProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }
    
    
}
