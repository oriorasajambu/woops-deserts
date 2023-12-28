<?php

namespace App\Livewire\Cart;

use Livewire\Component;

class PreviewCart extends Component
{
    public $carts;
    public $sessionId;
    public $subTotal;
    public $subTotalWithTax;
    public $orders;
    public $cartId;

    public function mount()
    {
        $this->sessionId = session()->getId();
        $cart = \Cart::session($this->sessionId);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->subTotal = $cart->getSubTotalWithoutConditions();
        $this->subTotalWithTax = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    public function render()
    {
        return view('livewire.cart.preview-cart');
    }

    function onClickVariant($id, $value) 
    {
        $cart = \Cart::session($this->sessionId);
        $cart->update($id,[
            'attributes' => array(
                'variant' => $value,
            )
        ]);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->cartId = $id;
        $this->carts = $sorted;
        $this->subTotal = $cart->getSubTotalWithoutConditions();
        $this->subTotalWithTax = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    function incrementQuantity($id) 
    {
        $cart = \Cart::session($this->sessionId);
        $cart->update($id,[
            'quantity' => 1
        ]);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->subTotal = $cart->getSubTotalWithoutConditions();
        $this->subTotalWithTax = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    function decrementQuantity($id) 
    {
        $cart = \Cart::session($this->sessionId);
        $cart->update($id,[
            'quantity' => -1
        ]);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->subTotal = $cart->getSubTotalWithoutConditions();
        $this->subTotalWithTax = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    function remove($id) 
    {
        $cart = \Cart::session($this->sessionId);
        $cart->remove($id);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->subTotal = $cart->getSubTotalWithoutConditions();
        $this->subTotalWithTax = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
        $this->dispatch('productRemoved');
    }
}
