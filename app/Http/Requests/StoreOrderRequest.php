<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => "bail|required|email:rfc,dns",
            "country" => "bail|required",
            "first_name" => "bail|required",
            "last_name" => "bail|required",
            "address" => "bail|required",
            "city" => "bail|required",
            "province" => "bail|required",
            "postal_code" => "bail|required|numeric",
            "phone" => "bail|required|numeric",
            "orders" => "bail|required",
            "sub_total" => "bail|required|numeric",
            "tax" => "bail|required|numeric",
            "total" => "bail|required|numeric",
        ];
    }
}
