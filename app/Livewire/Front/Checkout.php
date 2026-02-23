<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $currentStep = 1;
    public $cartItems = [];
    public $subtotal = 0;
    public $tax = 0;
    public $shipping = 10;
    public $discount = 0;
    public $total = 0;

    // Shipping Form
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $city = '';
    public $state = '';
    public $zipCode = '';
    public $country = '';

    // Billing Form
    public $sameAsShipping = true;
    public $billingFirstName = '';
    public $billingLastName = '';
    public $billingAddress = '';
    public $billingCity = '';
    public $billingState = '';
    public $billingZipCode = '';
    public $billingCountry = '';

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

    public function mount()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $this->loadCart();
        $this->populateUserData();
    }

    public function loadCart()
    {
        $this->cartItems = CartItem::where('user_id', Auth::id())->get()->toArray();
        $this->calculateTotals();
    }

    public function populateUserData()
    {
        $user = Auth::user();
        if ($user) {
            $this->firstName = $user->name ?? '';
            $this->email = $user->email ?? '';
        }
    }

    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)
            ->sum(fn($item) => $item['price'] * $item['quantity']);

        $this->discount = collect($this->cartItems)
            ->sum(fn($item) => (($item['old_price'] - $item['price']) * $item['quantity']));

        // Determine shipping cost based on selected method
        if ($this->subtotal > 50 && $this->shippingMethod === 'standard') {
            $this->shipping = 0;
        } else {
            $this->shipping = $this->shippingOptions[$this->shippingMethod]['price'] ?? 10;
        }

        $this->tax = round(($this->subtotal * 0.08), 2);
        $this->total = round($this->subtotal + $this->tax + $this->shipping - $this->discount, 2);
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
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipCode' => 'required|string',
            'country' => 'required|string',
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
                'billingZipCode' => 'required|string',
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

        // Create order in database and process payment
        // For now just redirect to success
        session()->flash('success', 'Order placed successfully!');
        return redirect('/order-confirmation');
    }

    public function render()
    {
        return view('front.checkout', [
            'currentStep' => $this->currentStep,
            'cartItems' => $this->cartItems,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'shipping' => $this->shipping,
            'discount' => $this->discount,
            'total' => $this->total,
            'shippingMethod' => $this->shippingMethod,
            'shippingOptions' => $this->shippingOptions,
        ]);
    }
}
