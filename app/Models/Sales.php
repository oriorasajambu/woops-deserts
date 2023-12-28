<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'user_id',
    ];

    function invoice(): HasOne {
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    public static function search($query)
	{
		return empty($query) ? static::join('invoices', 'invoices.id', '=', 'sales.invoice_id')->whereIn('invoices.status', ['paid', 'uploaded']) :
            static::join('invoices', 'invoices.id', '=', 'sales.invoice_id')
                ->where(function ($keyword) use($query){ //make sure to group your where & whereHas statements together
                    $keyword->where('sales.id', 'like', '%'.$query.'%')
                        ->whereIn('invoices.status', ['paid', 'uploaded'])
                        ->orWhere('sales.invoice_id', 'like', '%' . $query . '%')
                        ->orWhere('sales.user_id', 'like', '%' . $query . '%');
                });
	}
}
