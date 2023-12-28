<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'value',
    ];

    public static function search($query)
	{
		return empty($query) ? static::select() :
            static::where(function ($keyword) use($query){ //make sure to group your where & whereHas statements together
				$keyword->where('name', 'like', '%'.$query.'%')
                    ->orWhere('value', 'like', '%' . $query . '%')
                    ->orWhere('slug', 'like', '%' . $query . '%')
                    ->orWhere('id', 'like', '%' . $query . '%');
			});
	}
}
