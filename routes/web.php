<?php

use App\Models\User;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\UserManagement;
use App\Http\Controllers\AuthController;
use App\Livewire\Admin\Registered;
use App\Livewire\Business\Account;
use App\Livewire\Business\Booking;
use App\Livewire\Business\Review;
use App\Livewire\Business\Services;
use App\Livewire\Customer\Home;
use App\Livewire\Customer\Shop;
use App\Livewire\Register\Customer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('guest:web')->group(function(){

    // Route::get('/', function () {
    //     return view('back.pages.auth.login');
    // });

    Route::get('/', function () {
        return view('back.pages.auth.login');
    })->name('login');
    Route::post('/custom-login', [AuthController::class,'customLogin'])->name('custom.login');

     Route::get('/customer', function () {
        return view('livewire.register.customer');
    })->name('customer');
    Route::post('/store-customer', [AuthController::class,'storecustomer'])->name('store.customer');

     Route::get('/business', function () {
        return view('livewire.register.business');
    })->name('business');
     Route::post('/store-business', [AuthController::class,'storebusiness'])->name('store.business');
});



Route::middleware(['auth:web'],['revalidate'])->group(function() {


    #admin access only
    Route::prefix('admin-panel')->name('admin.')->group(function(){
        Route::get('/user-management', UserManagement::class)->name('user-management');
        Route::get('/registered', Registered::class)->name('registered');
     });

      #business access only
    Route::prefix('business-owner-panel')->name('business-owner.')->group(function(){
        Route::get('/booking', Booking::class)->name('booking');
        Route::get('/services', Services::class)->name('services');
        Route::get('/review', Review::class)->name('review');
        Route::get('/account', Account::class)->name('account');
     });

      #customer access only
    Route::prefix('customer-panel')->name('customer.')->group(function(){
        Route::get('/home', Home::class)->name('home');
        Route::get('/shop/{id}', Shop::class)->name('shop');

     });


    Route::get('/dashboard', Dashboard::class)->name('dashboard');

});