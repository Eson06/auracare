<?php

namespace App\Livewire\Business;

use App\Models\payment_details;
use Livewire\Component;
use Livewire\WithFileUploads;

class Account extends Component
{
     use WithFileUploads;
    public $name, $number, $qr, $type_account;


      public function AddPayment()
    {
        $this->validate([
              'type_account' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'qr' => 'required|image|max:2048', // 2MB limit
        ]);

        $qrPath = $this->qr->store('qr_codes', 'public');

        payment_details::create([
            'user_id' => auth()->user()->id, 
            'name' => $this->name,
            'type_account' => $this->type_account,
            'number' => $this->number,
            'qr' => $qrPath,
        ]);

        $this->showToastr('Payment Details Added.', 'success');
        $this->reset(['name', 'number', 'qr', 'type_account']);
    }


       public function showToastr($message, $type) {
        return $this->dispatch('showToastr',   message: $message, type: $type);
    }


     public function render()
    {
         $paymentDetails  = payment_details::where('user_id', auth()->user()->id)->get();
    return view('livewire.business.account', [
        'paymentDetails' => $paymentDetails,
    ]);
    }
}
