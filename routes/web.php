<?php

use App\Livewire\Admin\AccountSetting;
use App\Livewire\Admin\BrandCreateOrUpdate;
use App\Livewire\Admin\CategoryCreateOrUpdate;
use App\Livewire\Admin\ColorCreateOrUpdate;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\ProductCreateOrUpdate;
use App\Livewire\Admin\SubCategoryCreateOrUpdate;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Front\Checkout;
use App\Livewire\Front\Home;
use App\Livewire\Front\ProductCart;
use App\Livewire\Front\ProductDetails;
use App\Livewire\Front\Products;
use App\Livewire\Front\Wishlisted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// gust route
Route::middleware(['guest'])->group(function () {
Route::get('/register',Register::class)->name('register');
Route::get('/login',Login::class)->name('login');

});


Route::get('/',Home::class)->name('home');
Route::get('/products/{category?}/{subCategory?}',Products::class)->name('products');
Route::get('/product/{slug}',ProductDetails::class)->name('product-detail');
Route::get('/cart',ProductCart::class)->name('cart');
Route::get('/checkout',Checkout::class)->name('checkout');



// user route
Route::group(['prefix' => 'user','as'=>'user.','middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified',]],function() {
    Route::get('/dashboard', function () {
             $user = Auth::user();
        if ($user && $user->role !== 'admin') {
             return redirect()->route('user.dashboard');
        }else{
          return redirect()->route('admin.dashboard');
        }

    })->name('dashboard');

    // 👤 User dashboard
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

   Route::get('/my-wishlist',Wishlisted::class)->name('wishlist');

});


// Admin Route

Route::group(['prefix' => 'admin','as'=>'admin.','middleware' => ['auth:sanctum',config('jetstream.auth_session'),'verified','admin',]],function() {
Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/category',CategoryCreateOrUpdate::class)->name('category');
Route::get('/sub-category',SubCategoryCreateOrUpdate::class)->name('sub-category');
Route::get('/brand',BrandCreateOrUpdate::class)->name('brand');
Route::get('/color',ColorCreateOrUpdate::class)->name('color');
Route::get('/product',ProductCreateOrUpdate::class)->name('product');
Route::get('/account-setting',AccountSetting::class)->name('account-setting');
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
//     'admin',
// ])->prefix('admin')->name('admin.')->group(function () {



// });