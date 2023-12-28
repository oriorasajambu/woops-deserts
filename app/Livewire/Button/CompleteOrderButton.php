<?php

namespace App\Livewire\Button;

use Livewire\Component;

class CompleteOrderButton extends Component
{
    public $isCartEmpty;
    public $sessionId;

    protected $listeners = [
        'productAdded' => 'incrementQuantity',
        'productRemoved' => 'onProductRemoved',
    ];

    public function mount()
    {
        $this->sessionId = session()->getId();
        $this->isCartEmpty = \Cart::session($this->sessionId)->isEmpty();
    }

    public function render()
    {
        return view('livewire.button.complete-order-button');
    }

    function onProductRemoved() 
    {
        $this->isCartEmpty = \Cart::session($this->sessionId)->isEmpty();
    }
}
