<div>
    @if (count($categories) > 0)
        <section class="py-20 bg-gray-50">
            <div class="px-4 md:px-8 lg:px-16 xl:px-24">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                        Shop by Category
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Explore our curated collections and find exactly what you're looking for
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Category Card 1 -->

                    @foreach ($categories as $category)
                        <a href="{{ route('products', ['category' => $category->slug]) }}" wire:navigate
                            class="group relative overflow-hidden rounded-2xl h-64  hover:shadow-2xl transition-all duration-300 transform hover:scale-105  bg-black/20"
                            style="background-image: url('{{ asset('storage/uploads/category/' . $category->image) }}'); background-size: contain; background-position: center; background-repeat: no-repeat;">
                            <div
                                class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                            </div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white">

                                <h3 class="text-2xl font-bold">{{ $category->name }}</h3>
                                <p class="text-sm text-white font-medium mt-2">
                                    {{ $category->product_count }} items
                                </p>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif
</div>
