<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductSection extends Component
{
    public $sessionId;
    public $categories = null;
    public $product = null;
    public $products = null;
    public $id;
    public $name;
    public $slug;
    public $description;
    public $variant;
    public $price;
    public $original;
    public $category_id;
    public $user_id;

    public $images = [];
    public $imagesCount = 0;
    public $image = null;
    public $position = 0;

    public function mount()
    {
        $this->sessionId = session()->getId();
        $this->categories = Category::all();
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.product.product-section');
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
        if ($this->position == $this->imagesCount) {
            $this->position = 0;
        } else {
            $this->position++;
        }

        $this->image = $this->images[$this->position];
    }

    public function prevSlide()
    {
        if ($this->position == 0) {
            $this->position = $this->imagesCount;
        } else {
            $this->position--;
        }

        $this->image = $this->images[$this->position];
    }

    function initData(Product $product)
    {
        $this->product      = $product;
        $this->name         = $product->name;
        $this->id           = $product->id;
        $this->slug         = $product->slug;
        $this->description  = $product->description;
        $this->variant      = $product->variant;
        $this->price        = $product->price;
        $this->original     = $product->original;
        $this->category_id  = $product->category_id;
        $this->user_id      = $product->user_id;
        $this->images       = json_decode($product->original);
        $this->image        = $this->images[$this->position];
        $this->imagesCount  = count($this->images) - 1;
    }
}
