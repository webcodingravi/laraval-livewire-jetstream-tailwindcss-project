<div>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100" x-data="{
        showFilters: false,
        selectedCategory: null,
        selectedRating: null,
        priceRange: [0, 500],
        searchQuery: '',
        sortBy: 'popular',
        showMobileFilters: false,
        showMobileSearchNav: false,
        cartCount: 3,
        wishlistCount: 5
    }">


        <!-- Page Header Section -->
        <div class="bg-gradient-to-r from-[#24bad8] via-[#0b7a93] text-white px-4 md:px-6 lg:px-8 py-16 mt-20">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                    Wishlist
                </h1>


            </div>
        </div>

        <!-- Main Content -->
        <div class="w-11/12 mx-auto  py-12">

            <!-- Enhanced Breadcrumb Navigation -->
            <div class="mb-10 bg-white rounded-xl overflow-hidden border border-gray-100">
                <div class="px-4 md:px-8 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm">
                        <a href="{{ route('home') }}" wire:navigate
                            class="flex items-center gap-1 text-indigo-600 hover:text-indigo-700 font-medium transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                        <span class="text-gray-400">/</span>
                        <span class="text-gray-900 font-semibold"><a href="{{ route('user.wishlist') }}"
                                wire:navigate>Wishlist</a></span>
                    </nav>
                </div>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <div class="container mx-auto py-10">

                    <h2 class="text-2xl font-bold mb-6">My Wishlist</h2>

                    @if ($wishlists->isEmpty())
                        <p>No products in wishlist.</p>
                    @else
                        @foreach ($wishlists as $wishlist)
                            <div
                                class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">

                                <!-- Product Image -->
                                <div class="aspect-square bg-gray-100 overflow-hidden relative">
                                    <a href="{{ route('product-detail', $wishlist->product->slug) }}" wire:navigate>
                                        <img src="{{ asset('storage/uploads/product/' . $wishlist->product->productImages->first()->image_name) }}"
                                            alt="{{ $wishlist->product->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500" />
                                    </a>


                                    <!-- Wishlist Button -->
                                    @if (Auth::check())
                                        <button wire:click="add_wishlists({{ $wishlist->product->id }})"
                                            class="absolute top-3 left-3 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center {{ $isWishlisted
                                                ? 'bg-rose-100 text-rose-600 border-rose-300'
                                                : 'bg-white text-gray-700 border-gray-300 hover:border-rose-300' }}">


                                            <svg class="w-5 h-5 mx-auto"
                                                fill="{{ $isWishlisted ? 'currentColor' : 'none' }}"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>



                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="absolute top-3 left-3 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center text-gray-700 border-gray-300 hover:border-rose-300">


                                            <svg class="w-5 h-5 mx-auto"
                                                fill="{{ $isWishlisted ? 'currentColor' : 'none' }}"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>



                                        </a>
                                    @endif



                                    @if ($wishlist->product->is_hot)
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
                                            href="{{ route('products', [$wishlist->product->category->slug, $wishlist->product->subCategory->slug]) }}">
                                            {{ $wishlist->product->subCategory->name }}
                                        </a>
                                    </p>

                                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 h-14">
                                        <a href="{{ route('product-detail', $wishlist->product->slug) }}"
                                            wire:navigate>{{ $wishlist->product->title }}</a>

                                    </h3>

                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="text-xl font-bold text-indigo-600">
                                            {{ config('app.currency.symbol') }}{{ number_format($wishlist->product->price, 2) }}
                                        </span>

                                        @if ($wishlist->product->old_price)
                                            <span class="text-gray-400 line-through">
                                                {{ config('app.currency.symbol') }}{{ number_format($wishlist->product->old_price, 2) }}
                                            </span>
                                        @endif
                                        @if ($wishlist->product->discount)
                                            <span class="font-medium text-rose-500">{{ $wishlist->product->discount }}%
                                                OFF</span>
                                        @endif
                                    </div>

                                    @if ($wishlist->product->quantity > 0)
                                        <span class="text-sm text-green-600 font-semibold block mb-3">
                                            In Stock ({{ $wishlist->product->quantity }} left)
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
            </div>


        </div>
    </div>
</div>
