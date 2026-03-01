<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Livewire\Admin\AccountSetting;
use App\Livewire\Admin\BrandCreateOrUpdate;
use App\Livewire\Admin\CategoryCreateOrUpdate;
use App\Livewire\Admin\ColorCreateOrUpdate;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\DiscountCodeCreateOrUpdate;
use App\Livewire\Admin\ProductCreateOrUpdate;
use App\Livewire\Admin\ShippingCreateOrUpdate;
use App\Livewire\Admin\SubCategoryCreateOrUpdate;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Front\Checkout;
use App\Livewire\Front\Home;
use App\Livewire\Front\OrderConfirmed;
use App\Livewire\Front\ProductCart;
use App\Livewire\Front\ProductDetails;
use App\Livewire\Front\Products;
use App\Livewire\Front\Wishlisted;
use App\Livewire\User\Dashboard as UserDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/products/{category?}/{subCategory?}', Products::class)->name('products');
Route::get('/product/{slug}', ProductDetails::class)->name('product-detail');
Route::get('/cart', ProductCart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/my-wishlist', Wishlisted::class)->name('wishlist');
Route::get('/order-confirmed/{orderId}', OrderConfirmed::class)->name('order.confirmed');

// gust route
Route::middleware(['guest'])->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
    // google se register
    Route::get('/auth/google', [SocialAuthController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [SocialAuthController::class, 'callback']);

});

// user route
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'user']], function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');

});

// Admin Route
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin']], function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/category', CategoryCreateOrUpdate::class)->name('category');
    Route::get('/sub-category', SubCategoryCreateOrUpdate::class)->name('sub-category');
    Route::get('/brand', BrandCreateOrUpdate::class)->name('brand');
    Route::get('/color', ColorCreateOrUpdate::class)->name('color');
    Route::get('/product', ProductCreateOrUpdate::class)->name('product');
    Route::get('/shipping-method', ShippingCreateOrUpdate::class)->name('shipping-method');
    Route::get('/discount-code', DiscountCodeCreateOrUpdate::class)->name('discountCode');
    Route::get('/account-setting', AccountSetting::class)->name('account-setting');
});
