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
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">All Products</h1>

            </div>
        </div>

        <!-- Main Content -->
        <div class="w-11/12 mx-auto  py-12">

            <!-- Enhanced Breadcrumb Navigation -->
            <div class="mb-10 bg-white rounded-xl overflow-hidden border border-gray-100">
                <div class="px-4 md:px-8 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm">
                        <a href="{{ route('home') }}"
                            class="flex items-center gap-1 text-indigo-600 hover:text-indigo-700 font-medium transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                        <span class="text-gray-400">/</span>
                        <span class="text-gray-900 font-semibold">Products</span>
                    </nav>


                </div>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Filters Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Mobile Filter Toggle -->
                    <button @click="showMobileFilters = !showMobileFilters"
                        class="lg:hidden w-full mb-4 py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:shadow-lg transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1H3zm0 3a1 1 0 011-1h12a1 1 0 011 1H3zm0 3a1 1 0 011-1h12a1 1 0 011 1H3zm0 3a1 1 0 011-1h12a1 1 0 011 1H3z">
                            </path>
                        </svg>
                        Filters
                    </button>

                    <!-- Filters Container -->
                    <div :class="{ 'hidden': !showMobileFilters }"
                        class="lg:block space-y-6 bg-white rounded-2xl shadow-lg p-6">
                        <!-- Categories Filter -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-5 h-5 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg"></span>
                                Categories
                            </h3>
                            <div class="space-y-2">
                                <template
                                    x-for="(category, idx) in ['Electronics', 'Fashion', 'Home & Garden', 'Sports', 'Beauty', 'Books']"
                                    :key="idx">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="radio" @change="selectedCategory = category"
                                            :checked="selectedCategory === category"
                                            class="w-4 h-4 text-indigo-600 cursor-pointer">
                                        <span class="text-gray-700 group-hover:text-indigo-600 transition"
                                            x-text="category"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-5 h-5 bg-gradient-to-r from-rose-500 to-pink-500 rounded-lg"></span>
                                Price Range
                            </h3>
                            <div class="space-y-4">
                                <input type="range" min="0" max="1000" x-model="priceRange[0]"
                                    class="w-full cursor-pointer">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="flex-1">
                                        <label class="text-sm text-gray-600 mb-1 block">Min Price</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-gray-600">$</span>
                                            <input type="number" x-model.number="priceRange[0]"
                                                class="w-full pl-6 pr-3 py-2 border-2 border-gray-200 rounded-lg focus:border-indigo-600 focus:outline-none">
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-sm text-gray-600 mb-1 block">Max Price</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-gray-600">$</span>
                                            <input type="number" x-model.number="priceRange[1]"
                                                class="w-full pl-6 pr-3 py-2 border-2 border-gray-200 rounded-lg focus:border-indigo-600 focus:outline-none">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <span>Selected:</span>
                                    <span class="font-bold text-indigo-600">$<span x-text="priceRange[0]"></span> -
                                        $<span x-text="priceRange[1]"></span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Ratings Filter -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-5 h-5 bg-yellow-400 rounded-lg"></span>
                                Ratings
                            </h3>
                            <div class="space-y-2">
                                <template x-for="(rating, idx) in [5, 4, 3, 2, 1]" :key="idx">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="radio" @change="selectedRating = rating"
                                            :checked="selectedRating === rating"
                                            class="w-4 h-4 text-yellow-400 cursor-pointer">
                                        <div class="flex items-center gap-1">
                                            <template x-for="star in 5" :key="star">
                                                <span
                                                    :class="star <= rating ? 'text-yellow-400' : 'text-gray-300'">★</span>
                                            </template>
                                            <span
                                                class="text-sm text-gray-600 group-hover:text-indigo-600 transition ml-1">&
                                                Up</span>
                                        </div>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- Brands Filter -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span class="w-5 h-5 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg"></span>
                                Brands
                            </h3>
                            <div class="space-y-2">
                                <template x-for="(brand, idx) in ['Sony', 'Samsung', 'LG', 'Apple', 'Bose', 'Philips']"
                                    :key="idx">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" class="w-4 h-4 text-indigo-600 rounded cursor-pointer">
                                        <span class="text-gray-700 group-hover:text-indigo-600 transition"
                                            x-text="brand"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- Colors Filter -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span
                                    class="w-5 h-5 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-lg"></span>
                                Colors
                            </h3>
                            <div class="flex gap-3 flex-wrap">
                                <button
                                    class="w-8 h-8 rounded-full bg-black shadow-md hover:shadow-lg hover:scale-110 transition border-2 border-gray-300"></button>
                                <button
                                    class="w-8 h-8 rounded-full bg-gray-400 shadow-md hover:shadow-lg hover:scale-110 transition border-2 border-gray-300"></button>
                                <button
                                    class="w-8 h-8 rounded-full bg-white shadow-md hover:shadow-lg hover:scale-110 transition border-2 border-gray-300"></button>
                                <button
                                    class="w-8 h-8 rounded-full bg-yellow-500 shadow-md hover:shadow-lg hover:scale-110 transition border-2 border-gray-300"></button>
                                <button
                                    class="w-8 h-8 rounded-full bg-red-500 shadow-md hover:shadow-lg hover:scale-110 transition border-2 border-gray-300"></button>
                                <button
                                    class="w-8 h-8 rounded-full bg-blue-500 shadow-md hover:shadow-lg hover:scale-110 transition border-2 border-gray-300"></button>
                            </div>
                        </div>

                        <!-- Clear Filters Button -->
                        <button
                            @click="selectedCategory = null; selectedRating = null; searchQuery = ''; priceRange = [0, 500]"
                            class="w-full py-3 px-4 border-2 border-indigo-600 text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition mt-6">
                            Clear All Filters
                        </button>
                    </div>
                </div>

                <!-- Products Grid Section -->
                <div class="lg:col-span-3">
                    <!-- Results Header -->
                    <div class="mb-6 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Showing Results</h2>
                            <p class="text-sm text-gray-600 mt-1">1 - 20 of 2,345 products</p>
                        </div>
                        <div class="text-sm text-gray-600">
                            <span class="font-semibold text-indigo-600">20</span> products per page
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                        <!-- Product Card Template - Replicate 9 times -->
                        <template x-for="product in [1, 2, 3, 4, 5, 6, 7, 8, 9]" :key="product">
                            <div
                                class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">
                                <!-- Product Image -->
                                <div
                                    class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden relative">
                                    <img src="https://via.placeholder.com/400" alt="Product"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                    <!-- Discount Badge -->
                                    <div
                                        class="absolute top-3 right-3 bg-gradient-to-r from-rose-500 to-pink-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                        -<span x-text="20 + product * 2"></span>%
                                    </div>

                                    <!-- Quick View Button -->
                                    <button
                                        class="absolute bottom-3 left-3 right-3 py-2 px-4 bg-white bg-opacity-0 hover:bg-opacity-100 text-indigo-600 font-bold rounded-lg backdrop-blur transition duration-300 flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Quick View
                                    </button>

                                    <!-- Wishlist Button -->
                                    <button
                                        class="absolute top-3 left-3 w-10 h-10 rounded-full bg-white shadow-lg hover:bg-rose-50 flex items-center justify-center transition">
                                        <svg class="w-5 h-5 text-gray-400 hover:text-rose-500 transition"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Product Info -->
                                <div class="p-4">
                                    <!-- Category -->
                                    <p class="text-xs font-semibold text-indigo-600 mb-1 uppercase tracking-wider">
                                        Electronics</p>

                                    <!-- Product Name -->
                                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 h-14">Premium Wireless <span
                                            x-text="'Product ' + product"></span></h3>

                                    <!-- Rating -->
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="text-yellow-400 text-sm">★★★★★</span>
                                        <span class="text-xs text-gray-500">(<span
                                                x-text="50 + product * 10"></span>)</span>
                                    </div>

                                    <!-- Pricing -->
                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="text-2xl font-bold text-indigo-600">$<span
                                                x-text="79 + product * 5"></span></span>
                                        <span class="text-lg text-gray-400 line-through">$<span
                                                x-text="99 + product * 5"></span></span>
                                    </div>

                                    <!-- Stock Status -->
                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                        <span class="text-xs font-semibold text-green-700">In Stock</span>
                                        <span class="text-xs text-gray-500 ml-auto"><span
                                                x-text="100 - product * 5"></span> Left</span>
                                    </div>

                                    <!-- Add to Cart Button -->
                                    <button
                                        class="w-full py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:shadow-lg transition transform hover:scale-105 active:scale-95">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Pagination -->
                    <div
                        class="flex flex-col sm:flex-row items-center justify-between gap-6 p-8 bg-white rounded-2xl shadow-lg">
                        <div class="text-gray-600">
                            <p class="font-medium">Showing <span class="text-indigo-600 font-bold">1 - 20</span> of
                                <span class="text-indigo-600 font-bold">2,345</span> results
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <button
                                class="p-2 border-2 border-gray-300 hover:border-indigo-600 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>

                            <template x-for="page in [1, 2, 3, 4, 5]" :key="page">
                                <button
                                    :class="page === 1 ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white' :
                                        'border-2 border-gray-300 text-gray-700 hover:border-indigo-600'"
                                    class="w-10 h-10 rounded-lg transition font-bold" x-text="page"></button>
                            </template>

                            <span class="text-gray-600">...</span>

                            <button
                                class="w-10 h-10 border-2 border-gray-300 text-gray-700 hover:border-indigo-600 rounded-lg font-bold transition">98</button>

                            <button class="p-2 border-2 border-gray-300 hover:border-indigo-600 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="text-sm text-gray-600">
                            Go to page: <input type="number" min="1" max="98"
                                class="w-12 px-2 py-1 border-2 border-gray-300 rounded focus:border-indigo-600 focus:outline-none text-center">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Content Section -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 border border-indigo-200 text-center">
                    <div class="text-4xl mb-3">📦</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Wide Selection</h3>
                    <p class="text-gray-700">Browse through 2,345+ premium products across all categories</p>
                </div>
                <div
                    class="bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl p-8 border border-rose-200 text-center">
                    <div class="text-4xl mb-3">✨</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Best Prices</h3>
                    <p class="text-gray-700">Exclusive discounts and deals on thousands of items</p>
                </div>
                <div
                    class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-8 border border-blue-200 text-center">
                    <div class="text-4xl mb-3">⚡</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Fast Delivery</h3>
                    <p class="text-gray-700">Get your orders delivered quickly and reliably</p>
                </div>
            </div>
        </div>
    </div>
</div>
