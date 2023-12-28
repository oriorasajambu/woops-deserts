<?php

namespace App\Livewire\Navbar;

use Livewire\Component;

class DashboardNavbar extends Component
{
    public $isCartEmpty;
    public $cartQuantity;
    public $sessionId;

    protected $listeners = [
        'productAdded' => 'incrementQuantity',
        'productRemoved' => 'decrementQuantity',
    ];

    public function mount()
    {
        $this->sessionId = session()->getId();
        $this->isCartEmpty = \Cart::session($this->sessionId)->isEmpty();
        $this->cartQuantity = \Cart::session($this->sessionId)->getContent()->count();
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
