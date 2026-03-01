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


                <!-- Product Card 1 -->
                <x-front.products.product-list :products="$featuredProducts" :isWishlisted="$isWishlisted" />


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
