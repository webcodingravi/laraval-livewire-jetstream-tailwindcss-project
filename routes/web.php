<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Livewire\Admin\AccountSetting;
use App\Livewire\Admin\BrandCreateOrUpdate;
use App\Livewire\Admin\CategoryCreateOrUpdate;
use App\Livewire\Admin\ColorCreateOrUpdate;
use App\Livewire\Admin\CreateOrUpdateHeroSlider;
use App\Livewire\Admin\Customers;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\DiscountCodeCreateOrUpdate;
use App\Livewire\Admin\OrderList;
use App\Livewire\Admin\PaymentSetting;
use App\Livewire\Admin\ProductCreateOrUpdate;
use App\Livewire\Admin\ShippingCreateOrUpdate;
use App\Livewire\Admin\SMTPSetting;
use App\Livewire\Admin\SubCategoryCreateOrUpdate;
use App\Livewire\Admin\SystemSetting;
use App\Livewire\Auth\ForgotPassword;
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

// Web Home page Route
Route::get('/', Home::class)->name('home');
// Web Product list Page Route
Route::get('/products/{category?}/{subCategory?}', Products::class)->name('products');
// Web Product Details Page Route
Route::get('/product/{slug}', ProductDetails::class)->name('product-detail');
// Web Add To Cart Route
Route::get('/cart', ProductCart::class)->name('cart');
// Web Checkout Product Route
Route::get('/checkout', Checkout::class)->name('checkout');
// Web My Wishllist Route
Route::get('/my-wishlist', Wishlisted::class)->name('wishlist');
// Web Order Confirmed Message Route
Route::get('/order-confirmed/{orderId}', OrderConfirmed::class)->name('order.confirmed');

// gust route
Route::middleware(['guest'])->group(function () {
    // User Regitster Route
    Route::get('/register', Register::class)->name('register');
    // User Login Route
    Route::get('/login', Login::class)->name('login');

    // Forgot Password Route
    Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
    // google se register
    Route::get('/auth/google', [SocialAuthController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [SocialAuthController::class, 'callback']);

});

// user route
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'user']], function () {
    // User Dashboard Route
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');

});

// Admin Route
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin']], function () {

    // Admin Dashboard Route
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');

    // Product Category Route
    Route::get('/category', CategoryCreateOrUpdate::class)->name('category');

    // Product Sub-Category Route
    Route::get('/sub-category', SubCategoryCreateOrUpdate::class)->name('sub-category');

    // Product Brand Route
    Route::get('/brand', BrandCreateOrUpdate::class)->name('brand');

    // Product Color Route
    Route::get('/color', ColorCreateOrUpdate::class)->name('color');

    // Product List and Careate and Update Route
    Route::get('/product', ProductCreateOrUpdate::class)->name('product');

    // Shipping Method Route
    Route::get('/shipping-method', ShippingCreateOrUpdate::class)->name('shipping-method');

    // Apply Discount Coupon Route
    Route::get('/discount-code', DiscountCodeCreateOrUpdate::class)->name('discountCode');

    // Order List Route
    Route::get('/order-list', OrderList::class)->name('orderList');

    // Account Setting Route
    Route::get('/account-setting', AccountSetting::class)->name('account-setting');

    // Pyament Setting Route
    Route::get('/payment-setting', PaymentSetting::class)->name('paymentSetting');

    // System Setting Route
    Route::get('/system-setting', SystemSetting::class)->name('systemSetting');

    // SMTP setting Route
    Route::get('/smtp-setting', SMTPSetting::class)->name('SMTPSetting');

    // Customer Route
    Route::get('/customer', Customers::class)->name('customers');

    // Hero slider Route admin
    Route::get('/hero-slider', CreateOrUpdateHeroSlider::class)->name('HeroSlider');

});
