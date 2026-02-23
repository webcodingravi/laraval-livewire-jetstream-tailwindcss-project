<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @if ($products->isEmpty())
            <div class="col-span-full">
                <div class="flex flex-col items-center justify-center py-20 px-4">
                    <!-- Empty State Icon -->
                    <div class="mb-6 relative">
                        <div
                            class="w-32 h-32 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-16 h-16 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Text Content -->
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 text-center">
                        No Products Found
                    </h2>
                    <p class="text-gray-600 text-center mb-2 max-w-md">
                        We couldn't find any products matching your criteria.
                    </p>
                    <p class="text-gray-500 text-sm text-center mb-8 max-w-md">
                        Try adjusting your filters or browse our full collection to discover amazing items.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('home') }}" wire:navigate
                            class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:shadow-lg transition transform hover:scale-105 active:scale-95">
                            <i class="ri-home-line mr-2"></i>Back to Home
                        </a>
                        <a href="{{ route('products', ['all', 'all']) }}" wire:navigate
                            class="px-8 py-3 border-2 border-indigo-600 text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition">
                            <i class="ri-shopping-bag-line mr-2"></i>Browse All Products
                        </a>
                    </div>
                </div>
            </div>
        @else
            @foreach ($products as $product)
                <div
                    class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">

                    <!-- Product Image -->
                    <div class="aspect-square bg-gray-100 overflow-hidden relative">
                        <a href="{{ route('product-detail', $product->slug) }}" wire:navigate>
                            <img src="{{ asset('storage/uploads/product/' . $product->productImages->first()->image_name) }}"
                                alt="{{ $product->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
                        </a>


                        <!-- Wishlist Button -->
                        @if ($product && Auth::check())
                            <button wire:click="add_wishlists({{ $product->id }})"
                                class="absolute top-3 left-3 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center {{ $isWishlisted
                                    ? 'bg-rose-100 text-rose-600 border-rose-300'
                                    : 'bg-white text-gray-700 border-gray-300 hover:border-rose-300' }}">


                                <svg class="w-5 h-5 mx-auto" fill="{{ $isWishlisted ? 'currentColor' : 'none' }}"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>



                            </button>
                        @else
                            <a href="{{ route('login') }}"
                                class="absolute top-3 left-3 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-gray-700 border-gray-300 hover:border-rose-300">


                                <svg class="w-5 h-5 mx-auto" fill="{{ $isWishlisted ? 'currentColor' : 'none' }}"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>



                            </a>
                        @endif



                        @if ($product->is_hot)
                            <div
                                class="absolute top-3 right-3 bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                Hot
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">

                        <p class="text-xs font-semibold text-indigo-600 mb-1 uppercase">
                            <a wire:navigate
                                href="{{ route('products', [$product->category->slug, $product->subCategory->slug]) }}">
                                {{ $product->subCategory->name }}
                            </a>
                        </p>

                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 h-14">
                            <a href="{{ route('product-detail', $product->slug) }}"
                                wire:navigate>{{ $product->title }}</a>

                        </h3>

                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-xl font-bold text-indigo-600">
                                {{ config('app.currency.symbol') }}{{ number_format($product->price, 2) }}
                            </span>

                            @if ($product->old_price)
                                <span class="text-gray-400 line-through">
                                    {{ config('app.currency.symbol') }}{{ number_format($product->old_price, 2) }}
                                </span>
                            @endif
                            @if ($product->discount)
                                <span class="font-medium text-rose-500">{{ $product->discount }}% OFF</span>
                            @endif
                        </div>

                        @if ($product->quantity > 0)
                            <span class="text-sm text-green-600 font-semibold block mb-3">
                                In Stock ({{ $product->quantity }} left)
                            </span>
                        @else
                            <span class="text-sm text-red-600 font-semibold block mb-3">
                                Out of Stock
                            </span>
                        @endif

                        <!-- Add to Cart Button -->
                        @if (Auth::check())
                            <button
                                class="w-full py-2 bg-indigo-600 text-white font-bold rounded-lg hover:shadow-lg transition">
                                <i class="ri-shopping-cart-2-line"></i> Add to Cart
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                                class="block text-center w-full py-2 bg-indigo-600 text-white font-bold rounded-lg">
                                <i class="ri-shopping-cart-2-line"></i> Add to Cart
                            </a>
                        @endif

                    </div>
                </div>
            @endforeach

        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
