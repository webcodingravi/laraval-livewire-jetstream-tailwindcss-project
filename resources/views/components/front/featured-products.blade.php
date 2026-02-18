<div>
    @if (count($featuredProducts) > 0)
        <section class="py-20 bg-white">
            <div class="px-4 md:px-8 lg:px-16 xl:px-24">
                <div class="flex items-center justify-between mb-16">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                            Featured Products
                        </h2>
                        <p class="text-lg text-gray-600">
                            Best sellers and customer favorites
                        </p>
                    </div>
                    <a href="{{ route('products') }}" wire:navigate
                        class="hidden md:inline-flex px-6 py-3 bg-[#24bad8] text-white font-bold rounded-lg hover:bg-[#0b7a93] transition">
                        View All →
                    </a>
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Product Card 1 -->
                    @foreach ($featuredProducts as $featured)
                        <div
                            class="group bg-white rounded-2xl overflow-hidden border border-gray-200 hover:shadow-2xl transition-all duration-300">
                            <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-blue-400 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                                </div>
                                <div class="absolute top-4 right-4 z-10">
                                    <button
                                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-red-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            class="text-gray-400 hover:text-red-500">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute top-4 left-4">
                                    @if (!empty($featured->is_hot))
                                        <span
                                            class="px-3 py-1 bg-rose-500 text-white text-xs font-bold rounded-full">HOT</span>
                                    @endif

                                </div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <img src="{{ asset('storage/uploads/product/' . $featured->productImages->first()->image_name) }}"
                                        class="w-full h-full object-contain cursor-pointer">
                                </div>
                            </div>
                            <div class="p-6">
                                <p class="text-xs font-semibold text-indigo-600 mb-2 tracking-widest">
                                    <a wire:navigate
                                        href="{{ route('products', [$featured->category->slug, $featured->subCategory->slug]) }}">{{ $featured->subCategory->name }}</a>
                                </p>
                                <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-indigo-600 transition">
                                    <a wire:navigate
                                        href="{{ route('products', [$featured->category->slug, $featured->subCategory->slug]) }}">{{ $featured->title }}</a>
                                </h3>
                                <div class="flex items-center gap-1 mb-4">
                                    <span class="text-amber-400">★</span>
                                    <span class="text-amber-400">★</span>
                                    <span class="text-amber-400">★</span>
                                    <span class="text-amber-400">★</span>
                                    <span class="text-gray-300">★</span>
                                    <span class="text-xs text-gray-600 ml-2">(124 reviews)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span
                                            class="text-2xl font-black text-gray-900">{{ config('app.currency.symbol') }}{{ $featured->price }}</span>
                                        <span
                                            class="text-sm text-gray-500 line-through ml-2">{{ config('app.currency.symbol') }}{{ $featured->old_price }}</span>
                                    </div>
                                    <button
                                        class="p-2 bg-[#24bad8] text-white rounded-lg hover:bg-[#0b7a93] transition transform hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                            </path>
                                        </svg>
                                    </button>
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
