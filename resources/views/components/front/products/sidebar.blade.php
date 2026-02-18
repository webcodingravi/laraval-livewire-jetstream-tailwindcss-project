<div>
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
        <div :class="{ 'hidden': !showMobileFilters }" class="lg:block space-y-6 bg-white rounded-2xl shadow-lg p-6">
            <!-- Categories Filter -->
            @if (!empty($subCategories))
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-5 h-5 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg"></span>
                        Categories
                    </h3>


                    <div class="space-y-2">
                        @foreach ($subCategories as $category)
                            <div class="flex justify-between">
                                <template x-for="(category, idx) in ['{{ $category->name }}']" :key="idx">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" value="{{ $category->id }}"
                                            wire:model.live.debounce.300ms="selectedCategories"
                                            class="w-4 h-4 text-indigo-600 cursor-pointer focus:outline-none focus:ring-0">
                                        <span class="text-gray-700 group-hover:text-indigo-600 transition"
                                            x-text="category"></span>

                                    </label>
                                </template>
                                <div
                                    class="text-sm text-slate-600 font-medium w-6 h-6 bg-slate-200 rounded-full flex items-center justify-center ">
                                    <span>{{ $category->product_count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

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
                                <span
                                    class="absolute left-3 top-2 text-gray-600">{{ config('app.currency.symbol') }}</span>
                                <input type="number" x-model.number="priceRange[0]"
                                    class="w-full pl-6 pr-3 py-2 border-2 border-gray-200 rounded-lg focus:border-indigo-600 focus:outline-none">
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="text-sm text-gray-600 mb-1 block">Max Price</label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-2 text-gray-600">{{ config('app.currency.symbol') }}</span>
                                <input type="number" x-model.number="priceRange[1]"
                                    class="w-full pl-6 pr-3 py-2 border-2 border-gray-200 rounded-lg focus:border-indigo-600 focus:outline-none">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-600">
                        <span>Selected:</span>
                        <span class="font-bold text-indigo-600">{{ config('app.currency.symbol') }}<span
                                x-text="priceRange[0]"></span> -
                            {{ config('app.currency.symbol') }}<span x-text="priceRange[1]"></span></span>
                    </div>
                </div>
            </div>

            <!-- Brands Filter -->

            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-5 h-5 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg"></span>
                    Brands
                </h3>
                <div class="space-y-2">
                    @foreach ($brands as $brand)
                        <template x-for="(brand, idx) in ['{{ $brand->brand_name }}']" :key="idx">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" value="{{ $brand->id }}"
                                    wire:model.live.debounce.300ms="selectedBrands"
                                    class="w-4 h-4 text-indigo-600 rounded cursor-pointer focus:outline-none focus:ring-0">
                                <span class="text-gray-700 group-hover:text-indigo-600 transition"
                                    x-text="brand"></span>
                            </label>
                        </template>
                    @endforeach
                </div>
            </div>

            <!-- Colors Filter -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-5 h-5 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-lg"></span>
                    Colors
                </h3>
                <div class="flex gap-3 flex-wrap">
                    @foreach ($colors as $color)
                        <button style="background: {{ $color->code }}" wire:click="toggleColor({{ $color->id }})"
                            class="w-8 h-8 rounded-full shadow-md hover:shadow-lg hover:scale-110 transition border-2 focus:outline-none foucs:ring-0 {{ in_array($color->id, $selectedColors) ? 'ring-2 ring-black scale-110' : '' }}"></button>
                    @endforeach


                </div>
            </div>

            <!-- Clear Filters Button -->
            <button wire:click="clearAllFilters"
                class="w-full py-3 px-4 border-2 border-indigo-600 text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition mt-6">
                Clear All Filters
            </button>
        </div>
    </div>
</div>
