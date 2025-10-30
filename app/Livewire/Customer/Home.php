<?php

namespace App\Livewire\Customer;

use App\Models\business;
use Livewire\Component;

class Home extends Component
{

     public function render()
    {
         $businesses = business::all();
    return view('livewire.customer.home', [
        'businesses' => $businesses
    ]);
    }
}
