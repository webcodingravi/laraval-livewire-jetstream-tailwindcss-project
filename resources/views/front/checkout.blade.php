<div>

    @php
        $states = [
            'Andhra Pradesh',
            'Arunachal Pradesh',
            'Assam',
            'Bihar',
            'Chhattisgarh',
            'Goa',
            'Gujarat',
            'Haryana',
            'Himachal Pradesh',
            'Jharkhand',
            'Karnataka',
            'Kerala',
            'Madhya Pradesh',
            'Maharashtra',
            'Manipur',
            'Meghalaya',
            'Mizoram',
            'Nagaland',
            'Odisha',
            'Punjab',
            'Rajasthan',
            'Sikkim',
            'Tamil Nadu',
            'Telangana',
            'Tripura',
            'Uttar Pradesh',
            'Uttarakhand',
            'West Bengal',

            // Union Territories
            'Andaman and Nicobar Islands',
            'Chandigarh',
            'Dadra and Nagar Haveli and Daman and Diu',
            'Delhi',
            'Jammu and Kashmir',
            'Ladakh',
            'Lakshadweep',
            'Puducherry',
        ];
    @endphp
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
                                    <input type="text" wire:model.blur="first_name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('first_name') border-red-500 @enderror"
                                        placeholder="John">
                                    @error('firstName')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.blur="last_name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('last_name') border-red-500 @enderror"
                                        placeholder="Doe">
                                    @error('last_name')
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
                                        placeholder="Enter City">
                                    @error('city')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">State <span
                                            class="text-red-500">*</span></label>
                                    <select wire:model="state"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state }}">{{ $state }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Zip Code -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" wire:model.blur="zip_code" placeholder="Zip Code"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('zip_code') border-red-500 @enderror"
                                        placeholder="10001">
                                    @error('zip_code')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Country <span
                                            class="text-red-500">*</span></label>
                                    <select wire:model.blur="country"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent ">
                                        <option value="india">India</option>
                                    </select>
                                    @error('country')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror


                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="mt-8 flex justify-between">
                                <a href="{{ route('cart') }}"
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
                                            placeholder="Enter First Name..."
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
                                            placeholder="Enter Last Name..."
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingLastName') border-red-500 @enderror">
                                        @error('billingLastName')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                                class="text-red-500">*</span></label>
                                        <input type="email" wire:model.blur="billingEmail"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingEmail') border-red-500 @enderror"
                                            placeholder="john@example.com">
                                        @error('billingEmail')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone <span
                                                class="text-red-500">*</span></label>
                                        <input type="tel" wire:model.blur="billingPhone"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingPhone') border-red-500 @enderror"
                                            placeholder="(555) 000-0000">
                                        @error('billingPhone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <!-- Address (Full Width) -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Street Address
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingAddress"
                                            placeholder="Address..."
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingAddress') border-red-500 @enderror">
                                        @error('billingAddress')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- City -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">City <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.blur="billingCity" placeholder="City Name.."
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingCity') border-red-500 @enderror">
                                        @error('billingCity')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">State <span
                                                class="text-red-500">*</span></label>
                                        <select wire:model="billingState"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state }}">{{ $state }}</option>
                                            @endforeach
                                        </select>
                                        @error('billingState')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <!-- Zip Code -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code <span
                                                class="text-red-500">*</span></label>
                                        <input type="number" wire:model.blur="billingZipCode" placeholder="Zip Code"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('billingZipCode') border-red-500 @enderror">
                                        @error('billingZipCode')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <!-- Country -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Country <span
                                                class="text-red-500">*</span></label>
                                        <select wire:model.blur="billingCountry"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent ">
                                            <option value="india">India</option>
                                        </select>
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

                <div class="bg-white rounded-lg shadow p-6 {{ $currentStep === 3 ? '' : 'hidden' }}">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Method</h2>

                    <form wire:submit="nextStep">
                        <!-- Payment Method Selection -->
                        <div class="space-y-4 mb-8">
                            <!-- COD -->
                            <label
                                class="flex items-center p-4 border-2 {{ $paymentMethod === 'cod' ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }} rounded-lg cursor-pointer transition-colors">
                                <input type="radio" wire:model="paymentMethod" value="cod"
                                    class="w-5 h-5 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                <div class="ml-3">
                                    <p class="font-semibold text-gray-900">Cash On Delivery</p>
                                    <p class="text-sm text-gray-600">Quick and easy checkout</p>
                                </div>
                            </label>
                        </div>



                        <!-- Credit Card -->
                        <label
                            class="flex items-center p-4 border-2 {{ $paymentMethod == 'stripe' ? 'border-blue-600 bg-blue-50' : 'border-gray-200' }} rounded-lg cursor-pointer transition-colors">

                            <input type="radio" wire:model.live="paymentMethod" value="stripe"
                                class="w-5 h-5 text-blue-600 focus:ring-2 focus:ring-blue-500">

                            <div class="ml-3">
                                <p class="font-semibold text-gray-900">Credit or Debit Card</p>
                                <p class="text-sm text-gray-600">Visa, Mastercard, American Express</p>
                            </div>
                        </label>

                        <div class="mt-4 {{ $paymentMethod == 'stripe' ? '' : 'hidden' }}">
                            <div wire:ignore>
                                <div id="card-element" class="border p-3 rounded"></div>
                            </div>
                        </div>

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


                <!-- Step 4: Order Review -->
                @if ($currentStep === 4)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Review Your Order</h2>

                        <!-- Shipping Address -->
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping Address</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-900">{{ $first_name . ' ' . $last_name }}</p>
                                <p class="text-gray-600">{{ $address }}</p>
                                <p class="text-gray-600">{{ $city }}, {{ $state }}
                                    {{ $zip_code }}</p>
                                <p class="text-gray-600">{{ $country }}</p>
                                <p class="text-gray-600 mt-2">{{ $email }}</p>
                                <p class="text-gray-600">+91-{{ $phone }}</p>
                            </div>


                        </div>


                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Billing Address</h3>

                            @if ($sameAsShipping)
                                <h3 class="text-lg font-semibold text-gray-900">Same as shipping address</h3>
                            @else
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-900">{{ $billingFirstName . ' ' . $billingLastName }}</p>
                                    <p class="text-gray-600">{{ $billingAddress }}</p>
                                    <p class="text-gray-600">{{ $billingCity }}, {{ $billingState }}
                                        {{ $billingZipCode }}</p>
                                    <p class="text-gray-600">{{ $billingCountry }}</p>
                                    <p class="text-gray-600">{{ $billingEmail }}</p>
                                    <p class="text-gray-600">+91-{{ $billingPhone }}</p>
                                </div>
                            @endif
                        </div>



                        <!-- Order Items -->
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h3>
                            <div class="space-y-4 w-full">
                                @foreach ($cartItems as $item)
                                    <div class="p-4 bg-gray-50 rounded-lg flex gap-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $item['image'] ? asset('storage/uploads/product/' . $item['image']) : 'https://via.placeholder.com/120' }}"
                                                alt="{{ $item['title'] }}"
                                                class="h-32 w-32 object-cover rounded-lg border border-gray-200 cursor-pointer">

                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $item['title'] }}</p>
                                            <p class="text-sm text-gray-600 mt-1">SKU: {{ $item['sku'] }}
                                            </p>
                                            <p class="text-sm text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                                            <p class="font-semibold text-gray-900">Price:
                                                <span class="text-gray-900 font-medium">
                                                    {{ config('app.currency.symbol') . number_format($item['price'] * $item['quantity'], 2) }}</span>
                                            </p>
                                            <div class="space-y-2 mb-4">
                                                <div class="flex items-center gap-4 text-sm flex-wrap">
                                                    @if ($item['color'])
                                                        <span class="text-gray-600">
                                                            <span class="font-medium">Color:</span>
                                                            <span
                                                                class="ml-2 text-gray-900">{{ $item['color'] }}</span>
                                                        </span>
                                                    @endif
                                                    @if ($item['size'])
                                                        <span class="text-gray-600">
                                                            <span class="font-medium">Size:</span>
                                                            <span
                                                                class="ml-2 text-gray-900">{{ $item['size'] }}</span>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach


                                <div class="mt-4 bg-gray-50 rounded-lg p-4">
                                    <div class="flex justify-between text-gray-700 mb-4">
                                        <span>Subtotal</span>
                                        <span>{{ config('app.currency.symbol') . number_format($subtotal, 2) }}</span>
                                    </div>

                                    <div class="flex justify-between text-gray-700 mb-4">
                                        <span>Shipping</span>
                                        <span class="{{ $shipping == 0 ? 'text-green-600 font-medium' : '' }}">
                                            {{ $shipping == 0 ? 'Free' : config('app.currency.symbol') . number_format($shipping, 2) }}
                                        </span>

                                    </div>


                                    @if ($discount > 0)
                                        <div class="flex justify-between text-gray-700 mb-4">
                                            <span>Discount</span>
                                            <span
                                                class="text-green-600">-{{ config('app.currency.symbol') . number_format($discount, 2) }}</span>

                                        </div>
                                    @endif


                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-900">Total</span>
                                        <span
                                            class="text-lg font-bold text-gray-900">{{ config('app.currency.symbol') . number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Payment Method -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                @if ($paymentMethod === 'stripe')
                                    <p class="text-gray-900">Stripe Card ending in {{ substr($cardNumber, -4) }}</p>
                                @else
                                    <p class="text-gray-900">COD</p>
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
                            <button wire:click="placeOrder" wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed" wire:target="placeOrder"
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
                                    <span class="text-gray-900 font-medium">
                                        {{ config('app.currency.symbol') . number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Summary Totals -->
                        <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal</span>
                                <span>{{ config('app.currency.symbol') . number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Shipping</span>
                                <span class="{{ $shipping == 0 ? 'text-green-600 font-medium' : '' }}">
                                    {{ $shipping == 0 ? 'Free' : config('app.currency.symbol') . number_format($shipping, 2) }}
                                </span>
                            </div>

                            @if ($discount > 0)
                                <div class="flex justify-between text-gray-700">
                                    <span>Discount</span>
                                    <span
                                        class="text-green-600">-{{ config('app.currency.symbol') . number_format($discount, 2) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Total Price -->
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span
                                class="text-xl font-bold text-gray-900">{{ config('app.currency.symbol') . number_format($total, 2) }}</span>
                        </div>


                        <!-- Promo Code Section -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <label class="block text-sm font-medium text-gray-900 mb-2">Promo Code</label>
                            <div class="flex gap-2 mb-4">
                                <input type="text" placeholder="Enter code" wire:model="PromoCode"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button wire:click="applyCoupon" wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50 cursor-not-allowed" wire:target="applyDiscount"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                                    Apply
                                </button>
                            </div>
                            <div>

                                @error('PromoCode')
                                    <span class="text-rose-500 font-medium">{{ $message }}</span>
                                @enderror

                            </div>

                            @session('success')
                                <div
                                    class="mb-6 p-4 bg-green-50 border-2 border-green-200 rounded-lg flex items-start gap-3">
                                    <svg class="w-6 h-6 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-sm text-green-700 font-medium">{{ $value }}</p>
                                </div>
                            @endsession

                            @session('error')
                                <div
                                    class="mb-6 p-4 bg-rose-50 border-2 border-rose-200 rounded-lg flex items-start gap-3">
                                    <svg class="w-6 h-6 text-rose-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-sm text-rose-700 font-medium">{{ $value }}</p>
                                </div>
                            @endsession
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('livewire:init', function() {

            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
            const elements = stripe.elements();

            let card = null;

            // Function to mount card safely
            function mountCard() {

                const cardElement = document.getElementById('card-element');

                // If element exists and card not already mounted
                if (cardElement && !card) {

                    card = elements.create('card');

                    card.mount('#card-element');

                    console.log('Stripe card mounted');
                }
            }

            // Auto mount when DOM updates (important for step changes)
            Livewire.hook('morph.updated', () => {
                mountCard();
            });

            // Also mount when stripe selected
            Livewire.on('stripe-client-secret', () => {
                setTimeout(() => {
                    mountCard();
                }, 100);
            });


            // Confirm payment listener
            Livewire.on('confirm-stripe-payment', async ({
                client_secret
            }) => {

                if (!card) {
                    alert('Card not ready');
                    return;
                }

                const {
                    paymentIntent,
                    error
                } = await stripe.confirmCardPayment(
                    client_secret, {
                        payment_method: {
                            card: card,
                        }
                    }
                );

                if (error) {
                    alert(error.message);
                    return;
                }

                if (paymentIntent.status === 'succeeded') {

                    // IMPORTANT: send paymentIntent directly (not wrapped in object)
                    Livewire.dispatch('paymentSuccess', {
                        paymentIntent: paymentIntent
                    });
                }

            });

        });
    </script>
@endpush
