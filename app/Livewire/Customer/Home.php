<?php

namespace App\Livewire\Customer;

use App\Models\business;
use Livewire\Component;

class Home extends Component
{

    public function render()
    {
        $businesses = Business::where('status', 'approved')
            ->with('ratings') 
            ->get();
    
        return view('livewire.customer.home', [
            'businesses' => $businesses
        ]);
    }
    
    
}
