<div>
    @if ($trandingProducts && $trandingProducts->count())
        <section class="py-20 bg-white">
            <div class="px-4 md:px-8 lg:px-16 xl:px-24">
                <div class="flex items-center justify-between mb-16">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 mb-2">
                            Tradning Products
                        </h2>
                        <p class="text-md text-gray-600">
                            Best sellers and customer Tranding Product
                        </p>
                    </div>
                    <a href="{{ route('products') }}" wire:navigate
                        class="hidden md:inline-flex px-6 py-3 bg-[#24bad8] text-white font-bold rounded-lg hover:bg-[#0b7a93] transition">
                        View All →
                    </a>
                </div>

                <div class="md:grid grid-cols-4 gap-4">
                    @foreach ($trandingProducts as $product)
                        <div class="p-2">
                            <div wire:key="{{ $product->id }}"
                                class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">

                                <!-- Product Image -->
                                <div class="aspect-square bg-gray-100 overflow-hidden relative">
                                    <a href="{{ route('product-detail', $product->slug) }}" wire:navigate>
                                        @if (!empty($product->productImages->first()->image_name))
                                            <img src="{{ asset('storage/uploads/product/' . $product->productImages->first()->image_name) }}"
                                                alt="{{ $product->title }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
                                        @endif
                                    </a>


                                    <!-- Wishlist Button -->

                                    @if (Auth::check())
                                        <button wire:click="add_wishlists({{ $product->id }})"
                                            class="absolute top-3 left-3 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center {{ $isWishlisted[$product->id]
                                                ? 'bg-rose-100 text-rose-600 border-rose-300'
                                                : 'bg-white text-gray-700 border-gray-300 hover:border-rose-300' }}">


                                            <svg class="w-5 h-5 mx-auto"
                                                fill="{{ $isWishlisted[$product->id] ? 'currentColor' : 'none' }}"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>



                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" wire:navigate
                                            class="absolute top-3 left-3 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-gray-700 border-gray-300 hover:border-rose-300">


                                            <svg class="w-5 h-5 mx-auto"
                                                fill="{{ $isWishlisted[$product->id] ? 'currentColor' : 'none' }}"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>



                                        </a>
                                    @endif

                                    @if ($product->is_featured)
                                        <div
                                            class="absolute top-3 right-3 bg-[#0b7a93] text-white px-3 py-1 rounded-full text-xs font-bold">
                                            Featured
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="p-4">

                                    <p class="text-xs font-semibold text-[#0b7a93] mb-1 uppercase">
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
                                        <span class="text-xl font-bold text-[#0b7a93]">
                                            {{ config('app.currency.symbol') }}{{ number_format($product->price, 2) }}
                                        </span>

                                        @if ($product->old_price)
                                            <span class="text-gray-400 line-through">
                                                {{ config('app.currency.symbol') }}{{ number_format($product->old_price, 2) }}
                                            </span>
                                        @endif

                                        @if ($product->old_price > $product->price)
                                            <span class="ml-2 font-medium text-green-600">
                                                Save
                                                {{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%
                                            </span>
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
                                        <button wire:click="addToCart({{ $product->id }})"
                                            class="w-full py-2 bg-[#0b7a93] text-white font-bold rounded-lg hover:shadow-lg transition">
                                            <i class="ri-shopping-cart-2-line"></i> Add to Cart
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" wire:navigate
                                            class="block text-center w-full py-2 bg-[#0b7a93] text-white font-bold rounded-lg">
                                            <i class="ri-shopping-cart-2-line"></i> Add to Cart
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="text-center mt-12 md:hidden">
                    <a href="{{ route('products') }}" wire:navigate
                        class="inline-flex px-6 py-3 bg-[#24bad8] text-white font-bold rounded-lg hover:bg-[#0b7a93] transition">
                        View All Products →
                    </a>
                </div>
            </div>
        </section>
    @endif
</div>
