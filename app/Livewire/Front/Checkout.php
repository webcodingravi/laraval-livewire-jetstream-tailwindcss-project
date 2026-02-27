<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use App\services\CartCalculatorService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    public $currentStep = 1;
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 10;
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
    public $billingAddress = '';
    public $billingCity = '';
    public $billingState = '';
    public $billingZipCode = '';
    public $billingCountry = 'india';

    public $paymentMethod = 'credit_card';
    public $cardNumber = '';
    public $cardExpiry = '';
    public $cardCvc = '';
    public $cardName = '';
    public $shippingMethod = 'standard';

    public $shippingOptions = [
        'standard' => [
            'name' => 'Standard Shipping',
            'price' => 10,
            'delivery' => '5-7 business days',
            'description' => 'Regular delivery'
        ],
        'express' => [
            'name' => 'Express Shipping',
            'price' => 25,
            'delivery' => '2-3 business days',
            'description' => 'Faster delivery'
        ],
        'overnight' => [
            'name' => 'Overnight Shipping',
            'price' => 50,
            'delivery' => 'Next business day',
            'description' => 'Fastest delivery'
        ],
        'free' => [
            'name' => 'Free Shipping',
            'price' => 0,
            'delivery' => '7-10 business days',
            'description' => 'Available on orders over $50'
        ]
    ];



    public function applyCoupon()
{
    $this->validate([
        'PromoCode' => 'required|string'
    ]);

    try {
        $discountCode = DiscountCode::where('name', $this->PromoCode)
            ->whereDate('expiry_date', '>=', Carbon::today())
            ->first();

        if (!$discountCode) {
            session()->flash('error', 'Invalid or expired code');
            return;
        }

        // Promo discount calculate
        if ($discountCode->type === 'percent') {
            $this->discount = round(($this->subtotal * $discountCode->percent_amount) / 100, 2);
        } else {
            $this->discount = $discountCode->percent_amount;
        }

        session()->put('coupon',[
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
        if (!Auth::check()) {
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

        $this->calculateTotals();
    }

    public function populateUserData()
    {
        $user = Auth::user();
        if ($user) {
            $this->first_name = $user->first_name ?? '';
            $this->last_name = $user->last_name ?? '';
            $this->email = $user->email ?? '';
        }
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)
            ->sum(fn($item) => $item['price'] * $item['quantity']);

       // Shipping
          $this->shipping = $this->subtotal > 50 ? 0 : 0;

       $this->total = round($this->subtotal + $this->shipping - $this->discount);

    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validateStep1();
        } elseif ($this->currentStep === 2) {
            $this->validateStep2();
        } elseif ($this->currentStep === 3) {
            $this->validateStep3();
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
            'type' => 'required|in:shipping,billing'
        ]);
    }

    public function validateStep2()
    {
        if (!$this->sameAsShipping) {
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

    public function validateStep3()
    {
        if ($this->paymentMethod === 'credit_card') {
            $this->validate([
                'cardNumber' => 'required|regex:/^\d{16}$/',
                'cardExpiry' => 'required|regex:/^\d{2}\/\d{2}$/',
                'cardCvc' => 'required|regex:/^\d{3,4}$/',
                'cardName' => 'required|string',
            ]);
        }
    }

    public function toggleSameAsShipping()
    {
        $this->sameAsShipping = !$this->sameAsShipping;
    }

    public function updatedSameAsShipping($value) {
        if($value){
           $this->billingFirstName = $this->first_name;
           $this->billingLastName = $this->last_name;
           $this->billingAddress = $this->address;
           $this->billingCity = $this->city;
           $this->billingState = $this->state;
           $this->billingZipCode = $this->zip_code;
           $this->billingCountry = $this->country;



        }
    }

    public function updated($propertyName){
        if($this->sameAsShipping) {
         if(in_array($propertyName,[
             'first_name',
             'last_name',
             'address',
             'city',
             'state',
             'zip_code',
             'country',
         ])) {
           $this->billingFirstName = $this->first_name;
           $this->billingLastName = $this->last_name;
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
        // Validate all steps
        $this->validateStep1();
        $this->validateStep2();
        $this->validateStep3();

        $coupon = session('coupon');

         DB::beginTransaction();

        try{

           $cartItems = CartItem::where('user_id', auth()->id())->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart')
                    ->with('error', 'Your cart is empty');
            }



        //Save Shipping Address
        $shippingAddress = UserAddress::create([
            'user_id' => auth()->id(),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'fullname' => $this->first_name.' '.$this->last_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'type' => 'shipping'
        ]);

        //Save Billing address
        $billingAddress = UserAddress::create([
               'user_id' => auth()->id(),
               'first_name' => $this->billingFirstName,
               'last_name' => $this->billingLastName,
               'fullname' => $this->billingFirstName.' '.$this->billingLastName,
               'address' => $this->billingAddress,
               'city' => $this->billingCity,
               'state' => $this->billingState,
               'zip_code' => $this->billingZipCode,
               'country' => $this->billingCountry,
               'type' => 'billing'

        ]);



        //Create Order
        $order = Order::create([
              'user_id' => auth()->id(),
              'shipping_address_id' => $shippingAddress->id,
              'billing_address_id' => $billingAddress->id,
              'discount' => $this->discount,
              'discount_code' => $coupon['code'] ?? null,
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
              'shipping_country' => $shippingAddress->country
        ]);

         $orderNumber = 'ORD-'.date('Ymd').'-'.str_pad($order->id,4,'0',STR_PAD_LEFT);

         $order->update([
           'order_number' => $orderNumber
        ]);


        //Order Item
        foreach($this->cartItems as $item) {
               OrderItem::create([
              'order_id' => $order->id,
              'product_id' => $item['product_id'],
              'product_name' => $item['title'],
              'price' => $item['price'],
              'quantity' => $item['quantity'],
              'color' => $item['color'],
              'size' => $item['size'],
              'total_price'=> $item['price'] * $item['quantity']

        ]);

        }

        DB::commit();

        // Cart clear
        CartItem::where('user_id',auth()->id())->delete();


        session()->forget('coupon');
        // For now just redirect to success
        $this->dispatch('alert',type:'success',title:'Success!',text:"Order Successfully Placed Thank You!");
        return redirect()->route('cart');

        }

        catch(\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert',type:'error',title:'Error!', text:$e->getMessage());
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
            'shippingMethod' => $this->shippingMethod,
            'shippingOptions' => $this->shippingOptions,
        ]);
    }
}