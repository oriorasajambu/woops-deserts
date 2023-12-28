<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 
        'name',
        'slug',
    ];

    public function children()
    {
      return $this->hasMany(Category::class, 'parent_id');
    }
    
    public function products() : HasMany
    {
      return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public static function search($query)
    {
      return empty($query) ? static::select() :
              static::where(function ($keyword) use($query){ //make sure to group your where & whereHas statements together
          $keyword->where('name', 'like', '%'.$query.'%')
              ->orWhere('id', 'like', '%' . $query . '%')
              ->orWhere('slug', 'like', '%' . $query . '%');
        });
    }
}
