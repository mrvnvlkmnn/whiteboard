<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{

    protected $listeners = ['test'];

    public function test(){
        dd('testen');
        echo "test";
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
