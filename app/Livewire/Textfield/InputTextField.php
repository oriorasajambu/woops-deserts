<?php

namespace App\Livewire\Textfield;

use Livewire\Component;

class InputTextField extends Component
{
    public $id;
    public $type;
    public $label;
    public $optional = false;

    public function mount($id, $type, $label, $optional = false)
    {
        $this->id = $id;
        $this->type = $type;
        $this->label = $label;
        $this->optional = $optional;
    }

    public function render()
    {
        return view('livewire.textfield.input-text-field');
    }
}
