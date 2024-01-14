<?php

namespace App\Livewire\Navbar;

use App\Models\Category;
use App\Models\Order;
use Livewire\Component;

class DashboardNavbar extends Component
{
    public $sessionId = true;
    public $isCartEmpty;
    public $cartQuantity;
    public $categories;

    public $isOrderEmpty = true;
    public $orderQuantity;

    protected $listeners = [
        'productAdded' => 'incrementQuantity',
        'productRemoved' => 'decrementQuantity',
    ];

    public function mount()
    {
        $this->sessionId = session()->getId();

        $this->isCartEmpty = \Cart::session($this->sessionId)->isEmpty();
        $this->cartQuantity = \Cart::session($this->sessionId)->getContent()->count();

        $this->isOrderEmpty = count(Order::where('session', session()->getId())->where('status', '!=', 'canceled')->get()) == 0;
        $this->orderQuantity = count(Order::where('session', session()->getId())->where('status', '!=', 'canceled')->get());

        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.navbar.dashboard-navbar');
    }

    function incrementQuantity() 
    {
        $this->isCartEmpty = \Cart::session($this->sessionId)->isEmpty();
        $this->cartQuantity++;
    }

    function decrementQuantity() {
        $this->isCartEmpty = \Cart::session($this->sessionId)->isEmpty();
        $this->cartQuantity--;
    }
}
