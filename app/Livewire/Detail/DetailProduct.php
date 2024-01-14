<?php

namespace App\Livewire\Detail;

use App\Models\Product;
use Livewire\Component;

class DetailProduct extends Component
{
    public $sessionId;
    public $product = null;
    public $name;
    public $slug;
    public $description;
    public $variant;
    public $price;
    public $original;
    public $category_id;
    public $user_id;

    public function mount()
    {
        $this->sessionId = session()->getId();
    }

    public function render()
    {
        return view('livewire.detail.detail-product');
    }

    public function add()
    {
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

    public function remove()
    {
        \Cart::session(session()->getId())->remove($this->product->id);
        $this->dispatch('productRemoved');
    }

    public function nextSlide() 
    {
        $this->dispatch('next');
    }

    public function prevSlide()
    {
        $this->dispatch('prev');
    }

    function initData(Product $product) 
    {
        $this->product      = $product;
        $this->name         = $product->name;
        $this->slug         = $product->slug;
        $this->description  = $product->description;
        $this->variant      = $product->variant;
        $this->price        = $product->price;
        $this->original     = $product->original;
        $this->category_id  = $product->category_id;
        $this->user_id      = $product->user_id;
    }
}
