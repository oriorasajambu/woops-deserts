<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;

class PublicController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::all(),
            'products' => Product::all(),
            'sessionId' => session()->getId(),
        ];
        return view('public.contents.dashboard.index', $data);
    }

    public function cart() {
        $data = [
            'sessionId' => session()->getId(),
        ];
        return view('public.contents.cart.index', $data);
    }

    public function storeOrder(StoreOrderRequest $request) {
        $invoice = Invoice::create([
            'session' => session()->getId(),
            'email' => $request->get('email'),
            'country' => $request->get('country'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'company' => $request->get('company'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'province' => $request->get('province'),
            'postal_code' => $request->get('postal_code'),
            'phone' => $request->get('phone'),
            'orders' => $request->get('orders'),
            'sub_total' => $request->get('sub_total'),
            'tax' => $request->get('tax'),
            'total' => $request->get('total'),
            'status' => 'pending',
        ]);

        if ($invoice) {
            $order = Order::create([
                "invoice_id"   => $invoice->id,
                "status"       => 'pending',
                'session'      => session()->getId(),
            ]);
            if ($order) {
                \Cart::session(session()->getId())->clear();
                return redirect()->to('customer-order');
            }
            return redirect()->to('customer.orders');
        }
        return redirect()->to('customer.orders');
    }

    public function customerOrders() {
        return view('public.contents.orders.index');
    }

    public function signin() {
        $data = [
            'pages' => 'Sign In',
        ];
        return view('auth.sign-in', $data);
    }
}
