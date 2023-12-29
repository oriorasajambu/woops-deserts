<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "invoice_id",
        "payment_id",
        "user_id",
        "session",
        "status",
    ];

    /**
     * Get the invoice associated with the order.
     */
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    /**
     * Get the paymet associated with the order.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }

    public static function search($query)
	{
		return empty($query) ? static::select() :
            static::where(function ($keyword) use($query){ //make sure to group your where & whereHas statements together
				$keyword->where('status', 'like', '%'.$query.'%')
                    ->orWhere('id', 'like', '%' . $query . '%');
			});
	}
}
