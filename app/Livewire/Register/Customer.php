<?php

namespace App\Livewire\Register;

use Livewire\Component;

class Customer extends Component
{

    public function save() {
        dd('testing');
    }

    public function render()
    {
        return view('livewire.register.customer');
    }
}
