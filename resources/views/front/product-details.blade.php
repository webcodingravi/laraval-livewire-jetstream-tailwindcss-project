<div>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 md:py-12 px-4 md:px-6 lg:px-8 mt-[100px]">
        <!-- Breadcrumb Navigation -->
        <div class="md:w-11/12 px-8 md:px-0 mx-auto mb-8">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-indigo-600 transition" wire:navigate>Home</a>
                <span>/</span>
                <a href="{{ route('products', $product->category->slug) }}"
                    class="hover:text-indigo-600 transition">{{ $product->category->name }}</a>
                <span>/</span>
                <a href="{{ route('products', [$product->category->slug, $product->subCategory->slug]) }}"
                    class="text-gray-900 font-medium">{{ $product->subCategory->name }}</a>
            </div>
        </div>

        <!-- Main Product Container -->
        <div class="md:w-11/12 px-8 md:px-0 mx-auto" x-data="{
            selectedColor: 'black',
            selectedSize: 'standard',
            quantity: 1,
            activeTab: 'description',
            mainImage: '{{ asset('storage/uploads/product/' . $product->productImages->first()->image_name) }}'
        }">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-16">

                <!-- Product Image Gallery -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden group">
                        <div
                            class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <img :src="mainImage" alt="Product"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>


                    </div>

                    <!-- Thumbnail Images -->
                    <div class="grid grid-cols-4 gap-3">
                        @foreach ($product->productImages as $image)
                            <button @click="mainImage = '{{ asset('storage/uploads/product/' . $image->image_name) }}'"
                                class="aspect-square rounded-lg overflow-hidden border-2 border-indigo-600 shadow-md hover:shadow-lg transition">
                                <img src="{{ asset('storage/uploads/product/' . $image->image_name) }}" alt="View 1"
                                    class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>


                </div>

                <!-- Product Details Section -->
                <div class="space-y-6">
                    <!-- Product Title & Rating -->
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">{{ $product->title }}</h1>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="text-sm text-gray-600 ml-2">(248 reviews)</span>
                            </div>
                            @if ($product->quantity > 0)
                                <span
                                    class="flex items-center gap-2 px-3 py-1 bg-green-50 rounded-full border border-green-200">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                    <span class="text-sm font-medium text-green-700">In Stock ({{ $product->quantity }})
                                        left</span>

                                </span>
                            @else
                                <span class="text-sm text-red-600 font-semibold block mb-3">
                                    <span class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></span>
                                    <span class="text-sm font-medium text-rose-700">Out of Stock</span>

                                </span>
                            @endif



                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <form wire:submit.prevent="addToCart" class="flex flex-col gap-7">
                        <div
                            class="space-y-3 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl border border-indigo-200">
                            <div class="flex items-baseline gap-3">
                                <span
                                    class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">{{ config('app.currency.symbol') }}{{ number_format($price, 2) }}</span>
                                <input type="hidden" wire:model="price" value="{{ $price }}">

                                @if ($old_price)
                                    <span
                                        class="text-2xl text-gray-400 line-through">{{ config('app.currency.symbol') }}{{ number_format($old_price, 2) }}</span>
                                    <input type="hidden" wire:model="old_price" value="{{ $old_price }}">
                                @endif

                                @if ($product->discount)
                                    <span class="text-rose-500 font-medium">{{ $product->discount }}% OFF</span>
                                    <input type="hidden" wire:model="discount" value="{{ $product->discount }}">
                                @endif

                            </div>
                        </div>

                        <!-- Product Description -->
                        <div class="space-y-3">
                            {!! $product->short_description !!}

                        </div>

                        <!-- Color Selection -->

                        @if (!empty($product->colors) && $product->colors->count())
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-3">Color</label>
                                <select class="border border-slate-200 rounded cursor-pointer text-slate-800"
                                    wire:model="color">
                                    <option value="">--Select Color--</option>
                                    @foreach ($product->colors as $color)
                                        <option value="{{ $color->id }}">{{ ucfirst($color->name) }}</option>
                                    @endforeach
                                </select>
                                @error('color')
                                    <span class="text-rose-500 font-medium">{{ $message }}</span>
                                @enderror

                            </div>
                        @endif

                        <!-- Size Selection -->

                        @if (!empty($product->sizes) && $product->sizes->count())
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-3">Size</label>
                                <select class="border border-slate-200 rounded cursor-pointer text-slate-800"
                                    wire:model.live.debounce.300ms="product_size">
                                    <option value="">--Select Size--</option>
                                    @foreach ($product->sizes as $size)
                                        <option value="{{ $size->id }}">{{ ucfirst($size->product_size) }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('product_size')
                                    <span class="text-rose-500 font-medium">{{ $message }}</span>
                                @enderror

                            </div>
                        @endif


                        <!-- Quantity Selector -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-3">Quantity</label>
                            <div class="flex items-center gap-4">
                                <button type="button" wire:click="decrement"
                                    class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center font-bold text-gray-700 transition">−</button>
                                <input type="number" wire:model="quantity" min="1"
                                    class="w-16 text-center py-2 border-2 border-gray-300 rounded-lg font-bold focus:outline-none focus:border-indigo-600">
                                <button type="button" wire:click="increment"
                                    class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center font-bold text-gray-700 transition">+</button>

                            </div>
                        </div>
                        {{-- product id --}}
                        <input type="hidden" wire:model="productId" value="{{ $product->id }}">
                        <!-- Action Buttons -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 pt-4">
                            <!-- Add to Cart -->
                            <button type="submit" wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed" wire:target="addToCart"
                                class="col-span-2 py-4 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg hover:shadow-2xl transition transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8m10 0l2 8m-12 0h12"></path>
                                </svg>
                                Add to Cart
                            </button>
                    </form>



                    <!-- Wishlist -->
                    @if (Auth::check())
                        <button wire:click="add_wishlists({{ $product->id }})"
                            class="py-4 px-6 border-2 font-bold rounded-xl transition
                             {{ $isWishlisted
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
                            class="flex justify-center py-4 px-6 border-2 font-bold rounded-xl transition bg-white text-gray-700 border-gray-300 hover:border-rose-300">

                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>

                        </a>
                    @endif
                </div>




            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="">
            <!-- Tab Navigation -->
            <div class="flex flex-wrap gap-2 md:gap-6 border-b-2 border-gray-200 mb-8">
                <button @click="activeTab = 'description'"
                    :class="activeTab === 'description' ? 'text-indigo-600 border-b-2 border-indigo-600 font-bold' :
                        'text-gray-600 hover:text-gray-900'"
                    class="py-4 px-2 md:px-0 transition relative -mb-0.5">
                    Description
                </button>
                <button @click="activeTab = 'specifications'"
                    :class="activeTab === 'specifications' ? 'text-indigo-600 border-b-2 border-indigo-600 font-bold' :
                        'text-gray-600 hover:text-gray-900'"
                    class="py-4 px-2 md:px-0 transition relative -mb-0.5">
                    Specifications
                </button>
                <button @click="activeTab = 'reviews'"
                    :class="activeTab === 'reviews' ? 'text-indigo-600 border-b-2 border-indigo-600 font-bold' :
                        'text-gray-600 hover:text-gray-900'"
                    class="py-4 px-2 md:px-0 transition relative -mb-0.5">
                    Reviews (248)
                </button>

            </div>

            <!-- Tab Content -->
            <div class="bg-white rounded-xl p-8 shadow-md">
                <!-- Description Tab -->
                <div x-show="activeTab === 'description'" class="space-y-4">
                    {!! $product->description !!}

                </div>

                <!-- Specifications Tab -->
                <div x-show="activeTab === 'specifications'" class="space-y-4">
                    {!! $product->specifications !!}
                </div>

                <!-- Reviews Tab -->
                <div x-show="activeTab === 'reviews'" class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h3>

                        <!-- Review Summary -->
                        <div
                            class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-indigo-600">4.8</div>
                                <div class="text-yellow-400 text-lg">★★★★★</div>
                                <p class="text-xs text-gray-600 mt-1">248 reviews</p>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 text-sm mb-1">
                                    <span class="w-8">5★</span>
                                    <div class="flex-1 bg-gray-300 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                                    </div>
                                    <span class="w-8 text-right text-gray-600">212</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm mb-1">
                                    <span class="w-8">4★</span>
                                    <div class="flex-1 bg-gray-300 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 12%"></div>
                                    </div>
                                    <span class="w-8 text-right text-gray-600">30</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm mb-1">
                                    <span class="w-8">3★</span>
                                    <div class="flex-1 bg-gray-300 rounded-full h-2">
                                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 2%"></div>
                                    </div>
                                    <span class="w-8 text-right text-gray-600">4</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm mb-1">
                                    <span class="w-8">2★</span>
                                    <div class="flex-1 bg-gray-300 rounded-full h-2">
                                        <div class="bg-orange-500 h-2 rounded-full" style="width: 1%"></div>
                                    </div>
                                    <span class="w-8 text-right text-gray-600">2</span>
                                </div>
                            </div>
                            <div class="col-span-2 flex flex-col gap-2">
                                <button
                                    class="py-2 px-4 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                                    Write a Review
                                </button>
                                <button
                                    class="py-2 px-4 border-2 border-indigo-600 text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition">
                                    Verified Purchases Only
                                </button>
                            </div>
                        </div>

                        <!-- Individual Reviews -->
                        <div class="space-y-6">
                            <!-- Review 1 -->
                            <div class="pb-6 border-b border-gray-200">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <img src="https://via.placeholder.com/40" alt="User"
                                            class="w-10 h-10 rounded-full">
                                        <div>
                                            <p class="font-semibold text-gray-900">John Mitchell</p>
                                            <p class="text-xs text-gray-500">Verified Purchase • 2 weeks ago</p>
                                        </div>
                                    </div>
                                    <span class="text-yellow-400">★★★★★</span>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Best headphones I've ever owned!</h4>
                                <p class="text-gray-700 mb-3">The sound quality is exceptional, and the noise
                                    cancellation is incredibly effective. Battery life easily gets me through 5-6
                                    days of use. Highly recommend!</p>
                                <div class="flex gap-3">
                                    <button
                                        class="text-sm text-gray-600 hover:text-indigo-600 transition flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.359 6.718A2 2 0 0115.406 24H4m-5-8h16m0 0a2 2 0 110-4H3">
                                            </path>
                                        </svg>
                                        Helpful
                                    </button>
                                </div>
                            </div>

                            <!-- Review 2 -->
                            <div class="pb-6 border-b border-gray-200">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <img src="https://via.placeholder.com/40" alt="User"
                                            class="w-10 h-10 rounded-full">
                                        <div>
                                            <p class="font-semibold text-gray-900">Sarah Anderson</p>
                                            <p class="text-xs text-gray-500">Verified Purchase • 1 month ago</p>
                                        </div>
                                    </div>
                                    <span class="text-yellow-400">★★★★★</span>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Premium quality at a great price</h4>
                                <p class="text-gray-700 mb-3">Exceeded my expectations in every way. The comfort is
                                    outstanding even for extended listening sessions. Worth every penny!</p>
                                <div class="flex gap-3">
                                    <button
                                        class="text-sm text-gray-600 hover:text-indigo-600 transition flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.359 6.718A2 2 0 0115.406 24H4m-5-8h16m0 0a2 2 0 110-4H3">
                                            </path>
                                        </svg>
                                        Helpful
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Show More Reviews Button -->
                        <button
                            class="w-full py-3 mt-6 border-2 border-indigo-600 text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition">
                            Load More Reviews
                        </button>
                    </div>
                </div>


            </div>
        </div>

        <!-- Related Products Section -->
        @if ($relatedProducts->isNotEmpty())
            <div class="mt-20">
                <div class="mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">You Might Also Like</h2>
                    <p class="text-gray-600">Discover other premium audio products</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Product Card 1 -->
                    @foreach ($relatedProducts as $product)
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
                                        <span class="font-medium text-rose-500">{{ $product->discount }}%
                                            OFF</span>
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


                </div>
            </div>
        @endif
    </div>
</div>
</div>
