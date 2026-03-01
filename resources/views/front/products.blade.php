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
                    {{ $subCategories[0]->category->name ?? '' }}
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
                        <span class="text-gray-900 font-semibold"><a href="{{ route('products') }}"
                                wire:navigate>Products</a></span>

                        @if (!empty($category))
                            <span class="text-gray-400">/</span>
                            <span class="text-gray-900 font-semibold"><a href="{{ route('products', $category) }}"
                                    wire:navigate>{{ ucfirst($category) }}</a></span>
                        @endif

                        @if (!empty($subCategory))
                            <span class="text-gray-400">/</span>
                            <span class="text-gray-900 font-semibold"><a
                                    href="{{ route('products', $category, $subCategory) }}"
                                    wire:navigate>{{ ucfirst($subCategory) }}</a></span>
                        @endif

                    </nav>


                </div>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Filters Sidebar -->
                <x-front.products.sidebar :subCategories="$subCategories" :brands="$brands" :colors="$colors" :colors="$colors"
                    :selectedColors="$selectedColors" />

                <!-- Pagination -->




                <!-- Products Grid Section -->

                <div class="lg:col-span-3">
                    <!-- Products Grid -->
                    <x-front.products.product-list :products="$products" :isWishlisted="$isWishlisted" />

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
