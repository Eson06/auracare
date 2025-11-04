<?php

namespace App\Livewire\Customer;

use App\Models\order_details;
use Livewire\Component;

class Reservation extends Component
{
    public $selectedOrderId;
    public $name_service;
    public $rating;
    public $comment;
    
    public function openRatingModal($id)
    {
        $order = order_details::find($id);
    
        if ($order) {
            $this->selectedOrderId = $order->id;
            $this->name_service = $order->name_service;
            $this->rating = null;
            $this->comment = null;
            $this->dispatch('showRateModal');
        }
    }
    
    public function submitRating()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);
    
        $order = order_details::find($this->selectedOrderId);
    
        if ($order) {
            $order->ratings = $this->rating;
            $order->comment = $this->comment;
            $order->save();
            $this->showToastr('Rating posted successfully!', 'success');
            $this->dispatch('closeRateModal');
            $this->reset(['rating', 'comment']);
        }
    }

    
    public function showToastr($message, $type) {
        return $this->dispatch('showToastr',   message: $message, type: $type);
    }
    
    public function render()
    {
         $orderdetails = order_details::where('user_id', auth()->user()->id)->get();
    return view('livewire.customer.reservation', [
         'orderdetails' => $orderdetails,
    ]);
    }
}
