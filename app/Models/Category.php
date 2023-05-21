<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    protected $table = 'categories';

    public function SubCategory()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function rootCategories()
    {
        return $this->where('parent_id', 0)->with('SubCategory')->get();
    }
}
