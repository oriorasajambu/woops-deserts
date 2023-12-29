<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    public static function search($query)
	{
        $selectQuery = [
            'payments.id',
            'invoice_id',
            'payments.session',
            'receipt',
            'payments.created_at',
            'email',
            'country',
            'first_name',
            'last_name',
            'company',
            'address',
            'city',
            'province',
            'postal_code',
            'phone',
            'orders',
            'sub_total',
            'tax',
            'total',
            'payment_proof',
            'status',
            'canceled_by',
        ];
		return empty($query) ? static::select($selectQuery)->join('invoices', 'payments.invoice_id', '=', 'invoices.id')->where('invoices.status', 'paid') :
            static::join('invoices', 'invoices.id', '=', 'payments.invoice_id')
                ->where(function ($keyword) use($query) { //make sure to group your where & whereHas statements together
                    $keyword->where('payments.id', 'like', '%'.$query.'%')
                        ->where('invoices.status', 'paid')
                        ->orWhere('payments.invoice_id', 'like', '%' . $query . '%')
                        ->orWhere('payments.user_id', 'like', '%' . $query . '%');
                });
	}
}
