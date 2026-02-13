<?php

use App\Livewire\Admin\AccountSetting;
use App\Livewire\Admin\BrandCreateOrUpdate;
use App\Livewire\Admin\CategoryCreateOrUpdate;
use App\Livewire\Admin\ColorCreateOrUpdate;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\SubCategoryCreateOrUpdate;
use App\Livewire\Front\Home;
use App\Livewire\Front\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',Home::class)->name('home');
Route::get('/products',Products::class)->name('products');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // 🔁 Jetstream default dashboard (decision maker)
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user && $user->role !== 'admin') {
             return redirect()->route('user.dashboard');
        }else{
          return redirect()->route('admin.dashboard');
        }

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

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/category',CategoryCreateOrUpdate::class)->name('category');
 Route::get('/sub-category',SubCategoryCreateOrUpdate::class)->name('sub-category');
 Route::get('/brand',BrandCreateOrUpdate::class)->name('brand');
 Route::get('/color',ColorCreateOrUpdate::class)->name('color');
Route::get('/account-setting',AccountSetting::class)->name('account-setting');

});