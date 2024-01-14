<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'variant',
        'price',
        'original',
        'category_id',
        'user_id'
    ];

    /**
     * Get the category associated with the product.
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the user associated with the product.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function search($query)
    {
        return empty($query) ? static::select() :
                static::where(function ($keyword) use($query){ //make sure to group your where & whereHas statements together
            $keyword->where('name', 'like', '%'.$query.'%')
                ->orWhere('id', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('variant', 'like', '%' . $query . '%')
                ->orWhere('price', 'like', '%' . $query . '%')
                ->orWhere('slug', 'like', '%' . $query . '%');
            });
    }
}
