<?php

use App\Livewire\Admin\Category;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Front\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',Home::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // 🔁 Jetstream default dashboard (decision maker)
    Route::get('/dashboard', function () {

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');

    })->name('dashboard');


    // 👤 User dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin',
])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');

        Route::get('/category',Category::class)->name('category');

});
