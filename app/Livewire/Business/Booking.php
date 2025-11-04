<?php

namespace App\Livewire\Business;

use App\Models\order_details;
use Livewire\Component;

class Booking extends Component
{

     public function markAsCompleted($id)
{
    $order = order_details::find($id);

    if ($order) {
        $order->status = 'completed';
        $order->save();
        $this->showToastr('Order marked as completed successfully!', 'success');
    }
}

public function showToastr($message, $type) {
    return $this->dispatch('showToastr',   message: $message, type: $type);
}

    public function render()
    {
        $orderdetails = order_details::where('business_id', auth()->user()->id)->get();
    return view('livewire.business.booking', [
         'orderdetails' => $orderdetails,
    ]);
    }
}
