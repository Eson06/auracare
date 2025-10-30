<?php

namespace App\Livewire\Customer;

use App\Models\business;
use App\Models\order_details;
use App\Models\payment_details;
use App\Models\service;
use Livewire\Component;
use Illuminate\Support\Collection;
use Livewire\WithFileUploads;

class Shop extends Component
{
    use WithFileUploads;
    // Business info
    public $class_id, $user_id, $business_name, $business_address, $business_permit, $expiration_date, $email, $contact_number, $address, $picture;
    public $opening_time, $closing_time;

    // Service selection and booking
    public $selectedid, $name_service, $type_service, $price;
    public $servicestaff; // will be a Collection
    public $selectedStaff = null;
    public $selectedDateTime = null;
    public $date_schdedule, $selected_time, $amount_paid;
    public $payment_option;

    public function mount($id)
    {
        $mybusiness = business::findOrFail($id);

        $this->class_id = $mybusiness->id;
        $this->user_id = $mybusiness->user_id;
        $this->business_name = $mybusiness->business_name;
        $this->business_address = $mybusiness->business_address;
        $this->business_permit = $mybusiness->business_permit;
        $this->expiration_date = $mybusiness->expiration_date;
        $this->email = $mybusiness->email;
        $this->contact_number = $mybusiness->contact_number;
        $this->address = $mybusiness->address;
        $this->picture = $mybusiness->picture;
        $this->opening_time = $mybusiness->opening_time;
        $this->closing_time = $mybusiness->closing_time;

        $this->servicestaff = collect(); 
    }

public function getAvailableTimesProperty()
{
    $times = [
        '01:00 AM','02:00 AM','03:00 AM','04:00 AM','05:00 AM','06:00 AM',
        '07:00 AM','08:00 AM','09:00 AM','10:00 AM','11:00 AM','12:00 PM',
        '01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM',
        '07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM','12:00 AM'
    ];

    $open = strtotime($this->opening_time);
    $close = strtotime($this->closing_time);

    if ($close < $open) {
        $close += 24 * 60 * 60;
    }

    $filtered = [];
    foreach ($times as $time) {
        $t = strtotime($time);
        if ($t < $open) $t += 24 * 60 * 60;

        if ($t >= $open && $t <= $close) {
            $filtered[] = $time;
        }
    }

    return $filtered;
}



    public function openReservationModal($id)
    {
        $selectedService = service::findOrFail($id);

        $this->selectedid   = $selectedService->id;
        $this->name_service = $selectedService->name_service;
        $this->type_service = $selectedService->type_service;
        $this->price        = $selectedService->price;
        $this->servicestaff = $selectedService->servicestaff()->get();
        $this->selectedStaff = null;
        $this->selectedDateTime = null;

        $this->opening_time   = $selectedService->business->opening_time;
        $this->closing_time   = $selectedService->business->closing_time;
    }


public function updatedPaymentOption($value)
{
    if ($value === 'full') {
        $this->amount_paid = $this->price;
    } elseif ($value === 'half') {
        $this->amount_paid = $this->price / 2;
    } else {
        $this->amount_paid = null;
    }
}


    public function AddServices()
    {
        $this->validate([
            'selectedStaff' => 'required',
            'selectedDateTime' => 'required|date',
        ]);
        $this->dispatchBrowserEvent('showToastr', ['Service saved successfully.', 'success']);
        $this->selectedid = null;
        $this->name_service = null;
        $this->type_service = null;
        $this->price = null;
        $this->servicestaff = collect();
        $this->selectedStaff = null;
        $this->selectedDateTime = null;

    }

    public function getSelectedStaffName()
    {
        if (! $this->selectedStaff || $this->servicestaff->isEmpty()) {
            return null;
        }

        return optional($this->servicestaff->firstWhere('id', $this->selectedStaff))->full_name;
    }


    public function AddOrder()
{
    $this->validate([
        'name_service' => 'required|string|max:255',
        'type_service' => 'required|string|max:255',
        'price' => 'required|numeric',
        'date_schdedule' => 'required|date',
        'selected_time' => 'required|string',
        'amount_paid' => 'required|numeric|min:0',
        'picture' => 'nullable|image|max:8048',
    ], [
        'required' => 'This field is required.',
    ]);

    try {
        $neworder = new order_details();
        $neworder->name_service = $this->name_service;
        $neworder->type_service = $this->type_service;
        $neworder->price = $this->price;
        $neworder->date_schdedule = $this->date_schdedule;
        $neworder->selected_time = $this->selected_time;
        $neworder->amount_paid = $this->amount_paid;
        $neworder->user_id = auth()->user()->id;

        // Handle image upload
        if ($this->picture) {
            $filename = $this->picture->store('order_pictures', 'public');
            $neworder->picture = $filename;
        }

        $success = $neworder->save();

        if ($success) {
            $this->showToastr('Order successfully saved.', 'success');
            $this->reset(['date_schdedule', 'selected_time', 'picture', 'amount_paid']);
        } else {
            $this->showToastr('Something went wrong. Please contact the system administrator.', 'error');
        }

    } catch (\Exception $e) {
        $this->showToastr('An error occurred: ' . $e->getMessage(), 'error');
    }
}



    public function showToastr($message, $type) {
        return $this->dispatch('showToastr',   message: $message, type: $type);
    }

  public function render()
{
    $services = service::all();
    $payments = payment_details::where('user_id', $this->user_id)->get();

    return view('livewire.customer.shop', [
        'services' => $services,
        'payments' => $payments,
    ]);
}

}
