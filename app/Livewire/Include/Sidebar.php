<?php

namespace App\Livewire\Include;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public function LogoutHandler() {

        // Log::channel('users')->info('User {id} succesfully logged out.', ['id' => auth('web')->user()->email]);
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success','Log Out Successfully!');
    }
    public function render()
    {
        return view('livewire.include.sidebar');
    }
}
