<?php

namespace App\Livewire\Front;

use App\Models\CartItem;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingMethod;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\PaymentIntent;
use Stripe\Stripe;

// use Stripe\PaymentIntent;
// use Stripe\Stripe;

class Checkout extends Component
{
    public $currentStep = 1;

    public $cartItems = [];

    public $subtotal = 0;

    public $shipping = 0;

    public $discount = 0;

    public $total = 0;

    public $PromoCode;

    // Shipping Form
    public $first_name = '';

    public $last_name = '';

    public $email = '';

    public $phone = '';

    public $address = '';

    public $city = '';

    public $state = '';

    public $zip_code = '';

    public $country = 'india';

    public $type = 'shipping';

    // Billing Form
    public $sameAsShipping = true;

    public $billingFirstName = '';

    public $billingLastName = '';

    public $billingEmail = '';

    public $billingPhone = '';

    public $billingAddress = '';

    public $billingCity = '';

    public $billingState = '';

    public $billingZipCode = '';

    public $billingCountry = 'india';

    public $paymentMethod = 'cod';

    public $cardNumber = '';

    public $cardExpiry = '';

    public $cardCvc = '';

    public $cardName = '';

    public $shippingMethods = [];

    public $selectedShipping = null;

    public $clientSecret;

    public $orderId;

    public $orderNumber;

    protected $listeners = ['paymentSuccess'];

    public function applyCoupon()
    {
        $this->validate([
            'PromoCode' => 'required|string',
        ]);

        try {
            $discountCode = DiscountCode::where('name', $this->PromoCode)
                ->whereDate('expiry_date', '>=', Carbon::today())
                ->first();

            if (! $discountCode) {
                session()->flash('error', 'Invalid or expired code');

                return;
            }

            // Promo discount calculate
            if ($discountCode->type === 'percent') {
                $this->discount = round(($this->subtotal * $discountCode->percent_amount) / 100, 2);
            } else {
                $this->discount = $discountCode->percent_amount;
            }

            session()->put('coupon', [
                'code' => $discountCode->name,
                'value' => $discountCode->percent_amount,
                'type' => $discountCode->type,
            ]);

            // Recalculate totals (subtotal + shipping + discount)
            $this->calculateTotals();

            $this->PromoCode = '';

            session()->flash('success', 'Discount applied successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong: '.$e->getMessage());
        }
    }

    public function mount()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $this->loadCart();

        $this->populateUserData();
    }

    public function loadCart()
    {
        $this->cartItems = CartItem::where('user_id', Auth::id())->get()->toArray();
        if (count($this->cartItems) == 0) {
            return redirect()->route('cart')
                ->with('error', 'Your cart is empty');
        }

        // Load all active shipping methods
        $this->shippingMethods = ShippingMethod::where('status', 1)->get();

        // Auto select shipping
        $this->autoSelectShipping();

        // fetch address
        $savedAddress = UserAddress::where('user_id', auth()->id())->where('type', 'shipping')
            ->latest() // ensure latest
            ->first();

        if ($savedAddress) {
            $this->first_name = $savedAddress->first_name;
            $this->last_name = $savedAddress->last_name;
            $this->email = $savedAddress->email;
            $this->phone = $savedAddress->phone;
            $this->address = $savedAddress->address;
            $this->city = $savedAddress->city;
            $this->state = $savedAddress->state;
            $this->zip_code = $savedAddress->zip_code;
            $this->country = $savedAddress->country;
            $this->type = $savedAddress->type;

        }

        $this->calculateTotals();
    }

    public function populateUserData()
    {
        $user = Auth::user();
        if ($user) {
            $this->first_name = $user->first_name ?? '';
            $this->last_name = $user->last_name ?? '';
            $this->email = $user->email ?? '';
            $this->phone = $user->phone_number ?? '';
        }
    }

    // Automatically select shipping based on subtotal
    public function autoSelectShipping()
    {
        // Try to find free shipping eligible
        $freeShipping = $this->shippingMethods
            ->where('price', 0)
            ->where('min_order_amount', '<=', $this->subtotal)
            ->first();

        if ($freeShipping) {
            $this->selectedShipping = $freeShipping->id;
            $this->shipping = 0;
        } else {
            // Default to first available shipping method
            $default = $this->shippingMethods->first();
            if ($default) {
                $this->selectedShipping = $default->id;
                $this->shipping = $default->price;
            } else {
                $this->shipping = 0;
            }
        }
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)
            ->sum(fn ($item) => $item['price'] * $item['quantity']);

        if (count($this->cartItems) === 0) {
            $this->shipping = 0;
        } elseif ($this->selectedShipping) {
            $method = ShippingMethod::find($this->selectedShipping);
            if ($method) {
                $this->shipping = ($method->min_order_amount && $this->subtotal >= $method->min_order_amount)
                    ? 0
                    : $method->price;
            } else {
                $this->shipping = 0;
            }
        } else {
            $this->shipping = 0;
        }

        $this->total = round($this->subtotal + $this->shipping - $this->discount);

    }

    /**
     * When user selects a different shipping method
     */
    public function updatedSelectedShipping($value)
    {
        $this->calculateTotals();
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validateStep1();
        } elseif ($this->currentStep === 2) {
            $this->validateStep2();

        }

        if ($this->currentStep < 4) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function validateStep1()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|numeric',
            'country' => 'required|string',
            'type' => 'required|in:shipping,billing',
        ]);
    }

    public function validateStep2()
    {
        if (! $this->sameAsShipping) {
            $this->validate([
                'billingFirstName' => 'required|string',
                'billingLastName' => 'required|string',
                'billingAddress' => 'required|string',
                'billingCity' => 'required|string',
                'billingState' => 'required|string',
                'billingZipCode' => 'required|string|numeric',
                'billingCountry' => 'required|string',
            ]);
        }
    }

    public function toggleSameAsShipping()
    {
        $this->sameAsShipping = ! $this->sameAsShipping;
    }

    public function updatedSameAsShipping($value)
    {
        if ($value) {
            $this->billingFirstName = $this->first_name;
            $this->billingLastName = $this->last_name;
            $this->billingEmail = $this->email;
            $this->billingPhone = $this->phone;
            $this->billingAddress = $this->address;
            $this->billingCity = $this->city;
            $this->billingState = $this->state;
            $this->billingZipCode = $this->zip_code;
            $this->billingCountry = $this->country;

        }
    }

    public function updated($propertyName)
    {
        if ($this->sameAsShipping) {
            if (in_array($propertyName, [
                'first_name',
                'last_name',
                'phone',
                'email',
                'address',
                'city',
                'state',
                'zip_code',
                'country',
            ])) {
                $this->billingFirstName = $this->first_name;
                $this->billingLastName = $this->last_name;
                $this->billingEmail = $this->email;
                $this->billingPhone = $this->phone;
                $this->billingAddress = $this->address;
                $this->billingCity = $this->city;
                $this->billingState = $this->state;
                $this->billingZipCode = $this->zip_code;
                $this->billingCountry = $this->country;
            }
        }
    }

    public function updateShippingMethod($method)
    {
        if (array_key_exists($method, $this->shippingOptions)) {
            $this->shippingMethod = $method;
            $this->calculateTotals();
        }
    }

    public function placeOrder()
    {
        $this->validateStep1();
        $this->validateStep2();

        try {
            $order = $this->saveOrder();
            if (! $order) {
                return;
            }

            // Save order access in session (one-time)
            session()->put('order_access_'.$order->order_number, true);

            // Clear cart & coupon for COD
            if ($this->paymentMethod === 'cod') {
                CartItem::where('user_id', auth()->id())->delete();
                session()->forget('coupon');

                return redirect()->route('order.confirmed', $order->order_number);
            }

            // Stripe flow
            if ($this->paymentMethod === 'stripe') {
                $this->orderId = $order->order_number;

                Stripe::setApiKey(env('STRIPE_SECRET'));
                $paymentStripe = PaymentIntent::create([
                    'amount' => $this->total * 100,
                    'currency' => 'inr',
                    'metadata' => [
                        'order_id' => $order->order_number,
                        'user_id' => auth()->id(),
                    ],
                ]);

                $this->dispatch('confirm-stripe-payment', client_secret: $paymentStripe->client_secret);
            }

        } catch (\Exception $e) {

            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function updatedPaymentMethod($value)
    {
        if ($value == 'stripe') {
            $this->dispatch('stripe-client-secret');
        }
    }

    #[On('paymentSuccess')]
    public function paymentSuccess($paymentIntent = null)
    {
        if (! $paymentIntent) {
            return;
        }
        $order = Order::where('order_number', $this->orderId)->first();
        if (! $order) {
            return;
        }

        $order->update([
            'payment_status' => 'paid',
            'transaction_id' => $paymentIntent['id'],
            'payment_data' => json_encode($paymentIntent),
            'is_payment' => true,
        ]);

        CartItem::where('user_id', auth()->id())->delete();
        session()->forget('coupon');

        return redirect()->route('order.confirmed', $this->orderId);

    }

    private function saveOrder()
    {
        DB::beginTransaction();

        try {

            $cartItems = CartItem::where('user_id', auth()->id())->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart')
                    ->with('error', 'Your cart is empty');
            }

            // Save Shipping Address
            $shippingAddress = UserAddress::updateOrCreate(
                ['user_id' => auth()->id(), 'type' => 'shipping'],
                [
                    'user_id' => auth()->id(),
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'fullname' => $this->first_name.' '.$this->last_name,
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'address' => $this->address,
                    'city' => $this->city,
                    'state' => $this->state,
                    'zip_code' => $this->zip_code,
                    'country' => $this->country,
                    'type' => 'shipping',
                ]
            );
            // Billing
            $billingAddress = UserAddress::updateOrCreate(
                ['user_id' => auth()->id(), 'type' => 'billing'],
                [
                    'first_name' => $this->sameAsShipping ? $this->first_name : $this->billingFirstName,
                    'last_name' => $this->sameAsShipping ? $this->last_name : $this->billingLastName,
                    'fullname' => $this->sameAsShipping ? $this->first_name.' '.$this->last_name : $this->billingFirstName.' '.$this->billingLastName,
                    'phone' => $this->sameAsShipping ? $this->phone : $this->billingPhone,
                    'email' => $this->sameAsShipping ? $this->email : $this->billingEmail,
                    'address' => $this->sameAsShipping ? $this->address : $this->billingAddress,
                    'city' => $this->sameAsShipping ? $this->city : $this->billingCity,
                    'state' => $this->sameAsShipping ? $this->state : $this->billingState,
                    'zip_code' => $this->sameAsShipping ? $this->zip_code : $this->billingZipCode,
                    'country' => $this->sameAsShipping ? $this->country : $this->billingCountry,
                    'type' => 'billing',
                ]
            );

            // Create Order
            $coupon = session('coupon');
            $order = Order::create([
                'user_id' => auth()->id(),
                'shipping_address_id' => $shippingAddress->id,
                'billing_address_id' => $billingAddress->id,
                'discount' => $this->discount,
                'discount_code' => $coupon['code'] ?? null,
                'shipping_amount' => $this->shipping,
                'subtotal' => $this->subtotal,
                'total' => $this->total,
                'payment_method' => $this->paymentMethod,
                'total' => $this->total,
                'shipping_first_name' => $shippingAddress->first_name,
                'shipping_last_name' => $shippingAddress->last_name,
                'shipping_phone' => $shippingAddress->phone,
                'shipping_email' => auth()->user()->email,
                'shipping_address' => $shippingAddress->address,
                'shipping_city' => $shippingAddress->city,
                'shipping_state' => $shippingAddress->state,
                'shipping_zip' => $shippingAddress->zip_code,
                'shipping_country' => $shippingAddress->country,

            ]);

            $orderNumber = 'ORD-'.date('Ymd').'-'.str_pad($order->id, 4, '0', STR_PAD_LEFT);

            $order->update([
                'order_number' => $orderNumber,
            ]);

            // Order Item
            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['title'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'color' => $item['color'],
                    'size' => $item['size'],
                    'total_price' => $item['price'] * $item['quantity'],

                ]);

            }

            DB::commit();

            return $order;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());

            return null;

        }
    }

    public function render()
    {
        return view('front.checkout', [
            'currentStep' => $this->currentStep,
            'cartItems' => $this->cartItems,
            'subtotal' => $this->subtotal,
            'shipping' => $this->shipping,
            'discount' => $this->discount,
            'total' => $this->total,

        ]);
    }
}
