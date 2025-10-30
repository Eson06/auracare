<?php

namespace App\Livewire\Include;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Models\activity_log;
    

class Header extends Component
{
    public function LogoutHandler() {
        // Logout the user
        Auth::guard('web')->logout();
    
        // Redirect to login with message
        return redirect()->route('login')->with('success', 'Log Out Successfully!');
    }

    public function render()
    {
        return view('livewire.include.header');
    }
}
