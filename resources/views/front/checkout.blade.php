<div>
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <!-- Progress Steps -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="flex flex-col items-center flex-1">
                                <div class="flex items-center w-full">
                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-full {{ $currentStep >= $i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600' }} font-semibold">
                                        @if ($currentStep > $i)
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            {{ $i }}
                                        @endif
                                    </div>
                                    @if ($i < 4)
                                        <div
                                            class="flex-1 h-1 {{ $currentStep > $i ? 'bg-blue-600' : 'bg-gray-200' }} mx-2">
                                        </div>
                                    @endif
                                </div>
                                <p class="text-xs font-medium text-gray-600 mt-2">
                                    @if ($i === 1)
                                        Shipping
                                    @elseif ($i === 2)
                                        Billing
                                    @elseif ($i === 3)
                                        Payment
                                    @else
                                        Review
                                    @endif
                                </p>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Step 1: Shipping Information -->
                @if ($currentStep === 1)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Shipping Information</h2>

                        <form wire:submit="nextStep">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- First Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.blur="firstName"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('firstName') border-red-500 @enderror"
                                        placeholder="John">
                                    @error('firstName')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.blur="lastName"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lastName') border-red-500 @enderror"
                                        placeholder="Doe">
                                    @error('lastName')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" wire:model.blur="email"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                        placeholder="john@example.com">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone <span
                                            class="text-red-500">*</span></label>
                                    <input type="tel" wire:model.blur="phone"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                                        placeholder="(555) 000-0000">
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address (Full Width) -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Street Address <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.blur="address"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('address') border-red-500 @enderror"
                                        placeholder="123 Main St">
                                    @error('address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">City <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.blur="city"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('city') border-red-500 @enderror"
                                        placeholder="New York">
                                    @error('city')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">State <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.blur="state"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('state') border-red-500 @enderror"
                                        placeholder="NY">
                                    @error('state')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Zip Code -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.blur="zipCode"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('zipCode') border-red-500 @enderror"
                                        placeholder="10001">
                                    @error('zipCode')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Country <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.blur="country"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('country') border-red-500 @enderror"
                                        placeholder="United States">
                                    @error('country')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="mt-8 flex justify-between">
                                <a href="/products"
                                    class="px-6 py-2 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:border-gray-400 transition-colors">
                                    Back to Cart
                                </a>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                    Continue to Billing
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Step 2: Billing Address -->
                @if ($currentStep === 2)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Billing Address</h2>

                        <form wire:submit="nextStep">
                            <!-- Same as Shipping Checkbox -->
                            <div class="mb-6">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" wire:change="toggleSameAsShipping"
                                        {{ $sameAsShipping ? 'checked' : '' }}
                                        class="w-5 h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                                    <span class="text-gray-700 font-medium">Same as shipping address</span>
                                </label>
                            </div>

                            @if (!$sameAsShipping)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- First Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingFirstName"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingFirstName') border-red-500 @enderror">
                                        @error('billingFirstName')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Last Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingLastName"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingLastName') border-red-500 @enderror">
                                        @error('billingLastName')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Address (Full Width) -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Street Address
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingAddress"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingAddress') border-red-500 @enderror">
                                        @error('billingAddress')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- City -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">City <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingCity"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingCity') border-red-500 @enderror">
                                        @error('billingCity')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- State -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">State <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingState"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingState') border-red-500 @enderror">
                                        @error('billingState')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Zip Code -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingZipCode"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingZipCode') border-red-500 @enderror">
                                        @error('billingZipCode')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Country -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Country <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingCountry"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingCountry') border-red-500 @enderror">
                                        @error('billingCountry')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <!-- Navigation Buttons -->
                            <div class="mt-8 flex justify-between">
                                <button type="button" wire:click="previousStep"
                                    class="px-6 py-2 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:border-gray-400 transition-colors">
                                    Back
                                </button>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                    Continue to Payment
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Step 3: Payment Method -->
                @if ($currentStep === 3)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Method</h2>

                        <form wire:submit="nextStep">
                            <!-- Payment Method Selection -->
                            <div class="space-y-4 mb-8">
                                <!-- Credit Card -->
                                <label
                                    class="flex items-center p-4 border-2 {{ $paymentMethod === 'credit_card' ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }} rounded-lg cursor-pointer transition-colors">
                                    <input type="radio" wire:model="paymentMethod" value="credit_card"
                                        class="w-5 h-5 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <div class="ml-3">
                                        <p class="font-semibold text-gray-900">Credit or Debit Card</p>
                                        <p class="text-sm text-gray-600">Visa, Mastercard, American Express</p>
                                    </div>
                                </label>

                                <!-- PayPal -->
                                <label
                                    class="flex items-center p-4 border-2 {{ $paymentMethod === 'paypal' ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }} rounded-lg cursor-pointer transition-colors">
                                    <input type="radio" wire:model="paymentMethod" value="paypal"
                                        class="w-5 h-5 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <div class="ml-3">
                                        <p class="font-semibold text-gray-900">PayPal</p>
                                        <p class="text-sm text-gray-600">Fast and secure payment</p>
                                    </div>
                                </label>

                                <!-- Apple Pay -->
                                <label
                                    class="flex items-center p-4 border-2 {{ $paymentMethod === 'apple_pay' ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }} rounded-lg cursor-pointer transition-colors">
                                    <input type="radio" wire:model="paymentMethod" value="apple_pay"
                                        class="w-5 h-5 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                    <div class="ml-3">
                                        <p class="font-semibold text-gray-900">Apple Pay</p>
                                        <p class="text-sm text-gray-600">Quick and easy checkout</p>
                                    </div>
                                </label>
                            </div>

                            <!-- Credit Card Details -->
                            @if ($paymentMethod === 'credit_card')
                                <div class="space-y-6 bg-gray-50 p-6 rounded-lg">
                                    <!-- Cardholder Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Cardholder Name
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="cardName"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cardName') border-red-500 @enderror"
                                            placeholder="John Doe">
                                        @error('cardName')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Card Number -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Card Number <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="cardNumber"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cardNumber') border-red-500 @enderror"
                                            placeholder="1234 5678 9012 3456" maxlength="16">
                                        @error('cardNumber')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Expiry and CVC -->
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Expiry Date
                                                <span class="text-red-500">*</span></label>
                                            <input type="text" wire:model.blur="cardExpiry"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cardExpiry') border-red-500 @enderror"
                                                placeholder="MM/YY" maxlength="5">
                                            @error('cardExpiry')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">CVC <span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" wire:model.blur="cardCvc"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cardCvc') border-red-500 @enderror"
                                                placeholder="123" maxlength="4">
                                            @error('cardCvc')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Security Info -->
                                    <div
                                        class="flex items-start gap-3 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <p class="text-sm text-blue-800">Your payment information is secure and
                                            encrypted.</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Navigation Buttons -->
                            <div class="mt-8 flex justify-between">
                                <button type="button" wire:click="previousStep"
                                    class="px-6 py-2 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:border-gray-400 transition-colors">
                                    Back
                                </button>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                    Review Order
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Step 4: Order Review -->
                @if ($currentStep === 4)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Review Your Order</h2>

                        <!-- Shipping Address -->
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping Address</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-900">{{ $firstName }} {{ $lastName }}</p>
                                <p class="text-gray-600">{{ $address }}</p>
                                <p class="text-gray-600">{{ $city }}, {{ $state }}
                                    {{ $zipCode }}</p>
                                <p class="text-gray-600">{{ $country }}</p>
                                <p class="text-gray-600 mt-2">{{ $email }}</p>
                                <p class="text-gray-600">{{ $phone }}</p>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h3>
                            <div class="space-y-4">
                                @foreach ($cartItems as $item)
                                    <div class="flex justify-between items-start p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $item['title'] }}</p>
                                            <p class="text-sm text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                        </div>
                                        <p class="font-semibold text-gray-900">
                                            ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                @if ($paymentMethod === 'credit_card')
                                    <p class="text-gray-900">Credit Card ending in {{ substr($cardNumber, -4) }}</p>
                                @elseif ($paymentMethod === 'paypal')
                                    <p class="text-gray-900">PayPal</p>
                                @else
                                    <p class="text-gray-900">Apple Pay</p>
                                @endif
                            </div>
                        </div>

                        <!-- Confirm Message -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
                            <p class="text-sm text-blue-800">By clicking "Place Order", you agree to our terms and
                                conditions and authorize payment.</p>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between">
                            <button type="button" wire:click="previousStep"
                                class="px-6 py-2 border-2 border-gray-300 text-gray-700 font-medium rounded-lg hover:border-gray-400 transition-colors">
                                Back
                            </button>
                            <button wire:click="placeOrder"
                                class="px-8 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                                Place Order
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow sticky top-6">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Summary</h2>

                        <!-- Cart Items Preview -->
                        <div class="space-y-3 mb-6 pb-6 border-b border-gray-200 max-h-64 overflow-y-auto">
                            @foreach ($cartItems as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">{{ $item['title'] }} x {{ $item['quantity'] }}</span>
                                    <span
                                        class="text-gray-900 font-medium">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Summary Totals -->
                        <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Shipping</span>
                                <span class="{{ $shipping == 0 ? 'text-green-600 font-medium' : '' }}">
                                    {{ $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2) }}
                                </span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Tax</span>
                                <span>${{ number_format($tax, 2) }}</span>
                            </div>
                            @if ($discount > 0)
                                <div class="flex justify-between text-gray-700">
                                    <span>Discount</span>
                                    <span class="text-green-600">-${{ number_format($discount, 2) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Total Price -->
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-3xl font-bold text-gray-900">${{ number_format($total, 2) }}</span>
                        </div>

                        <!-- Security Badges -->
                        <div class="mt-8 pt-6 border-t border-gray-200 space-y-3 text-center">
                            <div class="flex items-center justify-center gap-2 text-xs text-gray-600">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 111.414 1.414L7.414 9l3.293 3.293a1 1 0 01-1.414 1.414l-4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                SSL Secured
                            </div>
                            <div class="flex items-center justify-center gap-2 text-xs text-gray-600">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 111.414 1.414L7.414 9l3.293 3.293a1 1 0 01-1.414 1.414l-4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                PCI Compliant
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
