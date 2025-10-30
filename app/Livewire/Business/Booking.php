<?php

namespace App\Livewire\Business;

use App\Models\order_details;
use Livewire\Component;

class Booking extends Component
{

    public function render()
    {
         $orderdetails = order_details::all();
    return view('livewire.business.booking', [
         'orderdetails' => $orderdetails,
    ]);
    }
}
