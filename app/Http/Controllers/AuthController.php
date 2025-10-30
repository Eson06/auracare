<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\activity_log;
use App\Models\business;
use App\Models\customer;
use App\Models\user_role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function customLogin(Request $request)
    {

        $request->validate([
            'user_name' => ['required', Rule::exists('users')],
            'password' => 'required',
        ]);


            $credentials = $request->only('user_name', 'password');

            if( Auth::guard('web')->attempt($credentials) ){
                $User = User::where('user_name', $request->user_name)->get('is_enable')->first();
                $checkUser = User::where('user_name', $request->user_name)->get()->first();

                if ($checkUser->is_enable == true)
                {
                   
                    $urlIntended = session()->get('url.intended');
                    if($urlIntended != null) {
                        // Log::channel('users')->info('User {id} succesfully logged in. With Ip Address {ip} ', ['id' => $checkUser->user_name,'ip' => $request->getClientIp()]);
                        RateLimiter::clear($request->input('user_name').'_login');
                        return redirect()->to($urlIntended);
                    }
                    else {

                        RateLimiter::clear($request->input('user_name').'_login');
                        return redirect()->route('dashboard');

                    }


                }

                else
                {
                    Auth::guard('web')->logout();
                    // Log::channel('users')->alert('Banned User {id} is logging in. With Ip Address {ip}', ['id' => $User->user_name, 'ip' => $request->getClientIp()]);
                    return redirect()->route('login')->with('ban','This Account is disabled. Please contact System Administrator');
                }

            }
            else{

                $maxAttempts = 4;
                $lockoutTime = 120;

                if (RateLimiter::tooManyAttempts($request->input('user_name').'_login', $maxAttempts)) {
                    $User = User::where('user_name', $request->user_name)->get()->first();
                    $User['is_enable'] = false;
                    $Success = $User->update();
                    if($Success) {
                        // Log::channel('users')->alert('User {id} is banned from the system. Ip Address {ip}', ['id' => $User->user_name,'ip' => $request->getClientIp()]);
                        return redirect()->route('login')->with('ban','Too many log in attempts. Account disabled. Please contact System Administrator');
                    }
                    else {
                        // Log::channel('users')->critical('Failed to update User to Disable.', ['id' => $User->user_name]);
                        return redirect()->route('login')->with('fail','Please contact System Administrator');
                    }

                }

                $attempt = RateLimiter::hit($request->input('user_name').'_login', $lockoutTime);
                // Log::channel('users')->alert(' User {id} is trying to log in. But failed. with IP Address {ip}', ['id' => $request->user_name, 'ip' => $request->getClientIp()]);
                return redirect()->route('login')->with('fail',' User Name  or Password does not match. ' . $maxAttempts - $attempt + 1 . ' Attempt(s) remaining.');

            }
        }

          public function storecustomer(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'user_name' => 'required|string|unique:users,user_name',
        'password' => 'required|string|min:6',
        'email' => 'required|email|unique:customers,email',
        'contact_number' => 'required|string|max:20',
        'address' => 'required|string|max:255',
    ]);

    // Save to users table
    $userSaved = new User();
    $userSaved->first_name = $validated['first_name'];
    $userSaved->last_name = $validated['last_name'];
    $userSaved->user_name = $validated['user_name'];
    $userSaved->password = Hash::make($validated['password']);

    if ($userSaved->save()) {
        // Save to customers table
        $roleSaved = new user_role();
        $roleSaved->user_id = $userSaved->id;
        $roleSaved->role_id = "4";
        $roleSaved->save();

        $customerSaved = new Customer();
        $customerSaved->email = $validated['email'];
        $customerSaved->contact_number = $validated['contact_number'];
        $customerSaved->address = $validated['address'];
        $customerSaved->user_id = $userSaved->id; // optional, if you have relation
        $customerSaved->save();

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    return back()->with('error', 'Something went wrong. Please try again.');
}

public function storebusiness(Request $request)
{
    $validated = $request->validate([
        'first_name'         => 'required|string|max:50',
        'last_name'          => 'required|string|max:50',
        'user_name'          => 'required|string|unique:users,user_name',
        'password'           => 'required|string|min:6|confirmed',
        'email'              => 'required|email|unique:businesses,email',
        'contact_number'     => 'required|string|max:20',
        'address'            => 'required|string|max:255',
        'business_name'      => 'required|string|max:100',
        'business_address'   => 'required|string|max:255',
        'business_permit'    => 'required|string|max:50',
        'expiration_date'    => 'required|date|after:today',
    ]);

    // Save to users table
    $userSaved = new User();
    $userSaved->first_name = $validated['first_name'];
    $userSaved->last_name  = $validated['last_name'];
    $userSaved->user_name  = $validated['user_name'];
    $userSaved->password   = Hash::make($validated['password']);
    $userSaved->save();

    // Assign role (4 = Business Owner)
    $roleSaved = new user_role();
    $roleSaved->user_id = $userSaved->id;
    $roleSaved->role_id = 3;
    $roleSaved->save();

    // Save to businesses table
    $businessSaved = new Business();
    $businessSaved->user_id          = $userSaved->id;
    $businessSaved->email            = $validated['email'];
    $businessSaved->contact_number   = $validated['contact_number'];
    $businessSaved->address          = $validated['address'];
    $businessSaved->business_name    = $validated['business_name'];
    $businessSaved->business_address = $validated['business_address'];
    $businessSaved->business_permit  = $validated['business_permit'];
    $businessSaved->expiration_date  = $validated['expiration_date'];
    $businessSaved->save();

    return redirect()->route('login')->with('success', 'Business registration successful!');
}
}
