<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;

class PublicController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::all(),
            'sessionId' => session()->getId(),
        ];
        return view('public.contents.dashboard.index', $data);
    }

    public function cart() {
        $carts = \Cart::session(session()->getId());
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'VAT 12.5%',
            'type' => 'tax',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '10.0%',
            'attributes' => array( // attributes field is optional
                'description' => 'Value added tax',
                'more_data' => 'more data here'
            )
        ));
        $carts->condition($condition);
        $data = [
            'sessionId' => session()->getId(),
        ];
        return view('public.contents.cart.index', $data);
    }
}
