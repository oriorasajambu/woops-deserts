<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'receipt',
        'comment',
        'type',
    ];

    public static function search($query)
	{
		return empty($query) ? static::select() :
            static::where(function ($keyword) use($query) { //make sure to group your where & whereHas statements together
				$keyword->where('user_id', 'like', '%'.$query.'%')
                    ->orWhere('comment', 'like', '%' . $query . '%')
                    ->orWhere('type', 'like', '%' . $query . '%')
                    ->orWhere('id', 'like', '%' . $query . '%');
			});
	}
}
