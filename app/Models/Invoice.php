<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        "email" ,
        "country",
        "first_name",
        "last_name",
        "company",
        "address",
        "city",
        "province",
        "postal_code",
        "phone",
        "orders",
        "sub_total",
        "tax",
        "total",
        "payment_proof",
        "status",
        "canceled_by",
    ];

    public static function search($query)
	{
		return empty($query) ? static::select() :
            static::where(function ($keyword) use($query){ //make sure to group your where & whereHas statements together
				$keyword->where('status', 'like', '%'.$query.'%')
                    ->orWhere('first_name', 'like', '%' . $query . '%')
                    ->orWhere('last_name', 'like', '%' . $query . '%')
                    ->orWhere('company', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('phone', 'like', '%' . $query . '%')
                    ->orWhere('company', 'like', '%' . $query . '%')
                    ->orWhere('address', 'like', '%' . $query . '%')
                    ->orWhere('id', 'like', '%' . $query . '%');
			});
	}
}
