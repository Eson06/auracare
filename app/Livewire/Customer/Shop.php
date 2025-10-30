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

    // Service selection and booking
    public $selectedid, $name_service, $type_service, $price;
    public $servicestaff; // will be a Collection
    public $selectedStaff = null;
    public $selectedDateTime = null;
    public $date_schdedule, $selected_time, $amount_paid;

    public function mount($id)
    {
        $mybusiness = business::findOrFail($id);

        $this->class_id = $mybusiness->id;
        $this->user_id = $mybusiness->user_id;
        $this->business_name = $mybusiness->business_name;
        // FIX: assign business_address from the correct field
        $this->business_address = $mybusiness->business_address;
        $this->business_permit = $mybusiness->business_permit;
        $this->expiration_date = $mybusiness->expiration_date;
        $this->email = $mybusiness->email;
        $this->contact_number = $mybusiness->contact_number;
        $this->address = $mybusiness->address;
        $this->picture = $mybusiness->picture;

        $this->servicestaff = collect(); // initialize as empty collection
    }

    /**
     * Open reservation modal and populate selected service + staff list
     */
    public function openReservationModal($id)
    {
        $selectedService = service::findOrFail($id);

        $this->selectedid   = $selectedService->id;
        $this->name_service = $selectedService->name_service;
        $this->type_service = $selectedService->type_service;
        $this->price        = $selectedService->price;
        $this->servicestaff = $selectedService->servicestaff()->get();

        // reset selection
        $this->selectedStaff = null;
        $this->selectedDateTime = null;

     
    }

    /**
     * Example AddServices stub — implement your actual saving logic here
     */
    public function AddServices()
    {
        $this->validate([
            'selectedStaff' => 'required',
            'selectedDateTime' => 'required|date',
        ]);

        // TODO: save reservation logic here...
        // e.g. Reservation::create([...]);

        $this->dispatchBrowserEvent('showToastr', ['Service saved successfully.', 'success']);

        // reset after saving
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
