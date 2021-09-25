<?php

namespace minify;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    private $tabel = 'categories';

    public function categories()
    {
        return $this->hasMany(Category::class,"parent_id");
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class,"parent_id")->with('categories');
    }
}
