<?php

namespace App\Livewire\Admin;

use App\Models\business;
use Livewire\Component;

class Registered extends Component
{
    public $filterType = '';

    public function approve($id)
    {
        $business = Business::find($id);
    
        if ($business) {
            $business->status = 'approved';
            $success = $business->save();
            if ($success) {
                $this->showToastr('Updated Successfully.', 'success');
            } else {
                $this->showToastr('Something went wrong. Please contact the system administrator.', 'error');
            }
        }
    }
    


public function showToastr($message, $type) {
    return $this->dispatch('showToastr',   message: $message, type: $type);
}

public function render()
{
    $query = Business::query();

    if (!empty($this->filterType)) {
        $query->where('business_type', $this->filterType);
    }

    $businesses = $query->get();

    return view('livewire.admin.registered', [
        'businesses' => $businesses,
    ]);
}

}
