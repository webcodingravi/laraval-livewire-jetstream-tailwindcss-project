<div>
    <!-- Header -->
    <div class="shadow-sm mt-[100px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
            <p class="mt-2 text-gray-600">Review and manage your items</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items Section -->
            <div class="lg:col-span-2">
                <!-- Cart Items Container -->
                <div class="bg-white rounded-lg shadow">
                    @if (empty($cartItems))
                        <!-- Empty Cart State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Your cart is empty</h3>
                            <p class="mt-2 text-sm text-gray-600">Start adding some products!</p>
                            <a href="/products"
                                class="mt-6 inline-flex items-center px-6 py-3 bg-[#0b7a93] text-white font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    @else
                        <!-- Cart Items List -->
                        <div class="divide-y divide-gray-200">

                            @foreach ($cartItems as $item)
                                @php
                                    $product = \App\Models\Product::find($item['product_id']);
                                @endphp

                                <!-- Cart Item -->
                                <div class="p-6 hover:bg-gray-50 transition-colors">
                                    <div class="flex gap-6">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0">
                                            <img src="{{ $item['image'] ? asset('storage/uploads/product/' . $item['image']) : 'https://via.placeholder.com/120' }}"
                                                alt="{{ $item['title'] }}"
                                                class="h-32 w-32 object-cover rounded-lg border border-gray-200 cursor-pointer">
                                        </div>

                                        <!-- Product Details -->

                                        <div class="flex-grow">
                                            <div class="flex justify-between items-start mb-4">
                                                <div>
                                                    <a href="{{ route('product-detail', $product->slug) }}">
                                                        <h3
                                                            class="text-lg font-semibold text-gray-900 hover:text-[#45AAC0]">
                                                            {{ $item['title'] }}
                                                        </h3>
                                                    </a>
                                                    <p class="text-sm text-gray-600 mt-1">SKU: {{ $item['sku'] }}
                                                    </p>
                                                </div>
                                                <button wire:click="removeFromCart({{ $item['id'] }})"
                                                    class="text-red-500 hover:text-red-700 font-medium transition-colors">
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Attributes -->
                                            <div class="space-y-2 mb-4">
                                                <div class="flex items-center gap-4 text-sm flex-wrap">
                                                    @if ($item['color'])
                                                        <span class="text-gray-600">
                                                            <span class="font-medium">Color:</span>
                                                            <span class="ml-2 text-gray-900">{{ $item['color'] }}</span>
                                                        </span>
                                                    @endif
                                                    @if ($item['size'])
                                                        <span class="text-gray-600">
                                                            <span class="font-medium">Size:</span>
                                                            <span class="ml-2 text-gray-900">{{ $item['size'] }}</span>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Quantity and Price -->
                                            <div
                                                class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                                <div class="flex items-center gap-3">
                                                    <label class="text-sm font-medium text-gray-700">Qty:</label>
                                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                                        <button
                                                            wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})"
                                                            class="px-3 py-2 text-gray-600 hover:bg-gray-100 transition-colors">−</button>
                                                        <input type="number" value="{{ $item['quantity'] }}"
                                                            min="1" readonly
                                                            class="w-12 text-center border-0 focus:ring-0 py-2 bg-white">
                                                        <button
                                                            wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})"
                                                            class="px-3 py-2 text-gray-600 hover:bg-gray-100 transition-colors">+</button>
                                                    </div>
                                                </div>

                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-gray-900">
                                                        {{ config('app.currency.symbol') }}{{ number_format($item['price'] * $item['quantity'], 2) }}
                                                    </div>

                                                    @if ($item['old_price'] > $item['price'])
                                                        <div class="text-sm text-gray-600">
                                                            <span class="line-through">
                                                                {{ config('app.currency.symbol') }}{{ number_format($item['old_price'] * $item['quantity'], 2) }}</span>
                                                            <span class="ml-2 font-medium text-green-600">
                                                                Save
                                                                {{ round((($item['old_price'] - $item['price']) / $item['old_price']) * 100) }}%
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Continue Shopping Link -->
                <div class="mt-6">
                    <a href="{{ route('home') }}" wire:navigate
                        class="flex items-center text-[#45AAC0] hover:text-[#0b7a93] font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow sticky top-6">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Order Summary</h2>

                        <!-- Summary Items -->
                        <div class="space-y-4 border-b border-gray-200 pb-6">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal</span>
                                <span>
                                    {{ config('app.currency.symbol') }}{{ number_format($subtotal, 2) }}</span>
                            </div>

                            <div class="flex justify-between text-gray-700">
                                <span>Shipping</span>
                                <span class="{{ $shipping == 0 ? 'text-green-600 font-medium' : '' }}">
                                    {{ $shipping == 0 ? 'Free' : config('app.currency.symbol') . number_format($shipping, 2) }}
                                </span>
                            </div>



                            <!-- Total -->

                            <div class="mt-6 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-3xl font-bold text-gray-900">
                                        {{ config('app.currency.symbol') }}{{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <!-- Process Checkout Button -->
                            <button wire:click="processToCheckout" wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed" wire:target="processToCheckout"
                                class="w-full block text-center bg-[#0b7a93] active:scale-95 duration-300 text-white font-semibold py-3 rounded-lg  mb-3 disabled:bg-gray-400 disabled:cursor-not-allowed">
                                <span wire:loading.remove wire:target="processToCheckout">Proceed to Checkout</span>


                                <span wire:loading wire:target="processToCheckout" class="flex gap-4">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z">
                                        </path>
                                    </svg>

                                </span>

                            </button>

                            <!-- Continue Shopping Button -->
                            <a href="{{ route('products') }}" wire:navigate
                                class="block w-full  text-center border-2 border-gray-300 text-gray-700 font-semibold py-3 rounded-lg hover:border-gray-400 transition-colors">
                                Continue Shopping
                            </a>





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
     <x-front.benefits-section/>

</div>
