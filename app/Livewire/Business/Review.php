<?php

namespace App\Livewire\Business;

use App\Models\order_details;
use Livewire\Component;

class Review extends Component
{

    public function render()
    {
        $orderdetails = order_details::where('business_id', auth()->user()->id)
        ->whereNotNull('ratings')
        ->get();
    
    return view('livewire.business.review', [
         'orderdetails' => $orderdetails,
    ]);
    }

}
