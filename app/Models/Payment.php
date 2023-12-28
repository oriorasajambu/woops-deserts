<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'user_id',
        'session',
        'receipt',
    ];

    function invoice(): HasOne {
        return $this->hasOne(Invoice::class, 'id', 'id');
    }

    public static function search($query)
	{
		return empty($query) ? static::join('invoices', 'invoices.id', '=', 'payments.invoice_id')->where('invoices.status', 'paid') :
            static::join('invoices', 'invoices.id', '=', 'payments.invoice_id')
                ->where(function ($keyword) use($query){ //make sure to group your where & whereHas statements together
                    $keyword->where('payments.id', 'like', '%'.$query.'%')
                        ->where('invoices.status', 'paid')
                        ->orWhere('payments.invoice_id', 'like', '%' . $query . '%')
                        ->orWhere('payments.user_id', 'like', '%' . $query . '%');
                });
	}
}
