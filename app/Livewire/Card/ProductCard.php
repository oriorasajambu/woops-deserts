<?php

namespace App\Livewire\Card;

use App\Models\Product;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $sessionId;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->sessionId = session()->getId();
    }

    public function render()
    {
        return view('livewire.card.product-card');
    }

    public function add() {
        \Cart::session(session()->getId())->add(array(
            'id' => $this->product->id,
            'name' => $this->product->name,
            'price' => $this->product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $this->product
        ));
        $this->dispatch('productAdded');
    }

    public function remove() {
        \Cart::session(session()->getId())->remove($this->product->id);
        $this->dispatch('productRemoved');
    }
}
