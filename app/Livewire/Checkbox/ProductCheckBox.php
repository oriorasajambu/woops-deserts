<?php

namespace App\Livewire\Checkbox;

use App\Models\Product;
use Livewire\Component;

class ProductCheckBox extends Component
{
    public $product;
    public $sessionId;
    public bool $checked = false;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->sessionId = session()->getId();
    }

    protected $listeners = [
        'addProduct' => 'add',
        'removeProduct' => 'remove',
    ];

    public function render()
    {
        return view('livewire.checkbox.product-check-box');
    }

    public function checkChanged() {
        if ($this->checked) {
            $this->dispatch('addProduct');
        } else {
            $this->dispatch('removeProduct');
        }
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
        $this->dispatch('initCart');
    }

    public function remove() {
        \Cart::session(session()->getId())->remove($this->product->id);
        $this->dispatch('initCart');
    }
}
