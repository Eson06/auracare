<?php

namespace App\Livewire\Admin;

use App\Models\business;
use Livewire\Component;

class Registered extends Component
{

     public function render()
    {
         $businesses = business::all();
    return view('livewire.admin.registered', [
        'businesses' => $businesses,
    ]);
    }
}
