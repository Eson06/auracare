<?php

namespace App\Livewire\Business;

use App\Models\service;
use App\Models\staff;
use Livewire\Component;
use Livewire\WithFileUploads;

class Services extends Component
{

    use WithFileUploads;
    public $full_name, $gender, $birthday, $picture, $business_id;
      public $name_service, $type_service, $price, $description, $staff_ids = [];

   public function AddStaff()
{
    $this->validate([
        'full_name' => 'required',
        'birthday' => 'required',
        'gender' => 'required',
        'picture' => 'nullable|image|max:8048',
    ], [
        'required' => 'This field is required.',
    ]);

    try {
        $newstaff = new Staff();
        $newstaff->full_name = $this->full_name;
        $newstaff->birthday = $this->birthday;
        $newstaff->gender = $this->gender;
        $newstaff->business_id = auth()->user()->id;
        // Handle image upload (if any)
        if ($this->picture) {
            $filename = $this->picture->store('staff_pictures', 'public');
            $newstaff->picture = $filename;
        }
        $success = $newstaff->save();

        if ($success) {
            $this->showToastr('Staff Added.', 'success');
            $this->reset(['full_name', 'birthday', 'gender', 'picture']);
            $this->dispatchBrowserEvent('close-modal');
        } else {
            $this->showToastr('Something went wrong. Please contact the system administrator.', 'error');
        }

    } catch (\Exception $e) {
    }
}

public function AddServices()
    {
        $this->validate([
            'name_service' => 'required|string|max:255',
            'type_service' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'picture' => 'nullable|image|max:8048',
            'staff_ids' => 'required|array|min:1',
        ]);

        $path = $this->picture ? $this->picture->store('services', 'public') : null;

        $service = service::create([
            'business_id' => auth()->user()->id, // adjust as needed
            'name_service' => $this->name_service,
            'type_service' => $this->type_service,
            'price' => $this->price,
            'description' => $this->description,
            'picture' => $path,
        ]);
        $service->staff()->attach($this->staff_ids);
        $this->showToastr('Services Added.', 'success');
        $this->reset(['name_service', 'type_service', 'price', 'description', 'picture', 'staff_ids']);
    }

    public function showToastr($message, $type) {
        return $this->dispatch('showToastr',   message: $message, type: $type);
    }

    public function render()
    {
         $staffs = staff::where('business_id', auth()->user()->id)->get();
         $services = service::where('business_id', auth()->user()->id)->get();
    return view('livewire.business.services', [
        'staffs' => $staffs,
         'services' => $services,
    ]);
    }
}
