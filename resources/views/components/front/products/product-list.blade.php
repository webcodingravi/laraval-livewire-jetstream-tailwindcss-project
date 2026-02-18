<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">

                <!-- Product Image -->
                <div class="aspect-square bg-gray-100 overflow-hidden relative">

                    <img src="{{ asset('storage/uploads/product/' . optional($product->productImages->first())->image_name) }}"
                        alt="{{ $product->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    <!-- Wishlist Button -->

                    <button
                        class="absolute top-3 left-3 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center">

                        <i class="ri-heart-line text-xl text-slate-400"></i>

                    </button>



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
                        {{ $product->title }}
                    </h3>

                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-xl font-bold text-indigo-600">
                            {{ config('app.currency.symbol') }}{{ $product->price }}
                        </span>

                        @if ($product->old_price)
                            <span class="text-gray-400 line-through">
                                {{ config('app.currency.symbol') }}{{ $product->old_price }}
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
                        <button
                            class="w-full py-2 bg-indigo-600 text-white font-bold rounded-lg hover:shadow-lg transition">
                            <i class="ri-shopping-cart-2-line"></i> Add to Cart
                        </button>
                    @else
                        <a href="{{ route('login') }}"
                            class="block text-center w-full py-2 bg-indigo-600 text-white font-bold rounded-lg">
                            Login to Buy
                        </a>
                    @endif

                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
