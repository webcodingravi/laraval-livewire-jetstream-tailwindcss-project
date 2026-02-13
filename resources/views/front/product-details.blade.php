<div>
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8 md:py-12 px-4 md:px-6 lg:px-8">
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
            <span>/</span>
            <a href="#" class="hover:text-indigo-600 transition">Electronics</a>
            <span>/</span>
            <span class="text-gray-900 font-medium">Premium Wireless Headphones</span>
        </div>
    </div>

    <!-- Main Product Container -->
    <div class="max-w-7xl mx-auto" x-data="{
        selectedColor: 'black',
        selectedSize: 'standard',
        quantity: 1,
        activeTab: 'description',
        showWishlist: false,
        mainImage: '/images/product-main.jpg'
    }">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-16">

            <!-- Product Image Gallery -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <img :src="mainImage" alt="Product" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>

                    <!-- Sale Badge -->
                    <div class="absolute top-4 right-4 bg-gradient-to-r from-rose-500 to-pink-500 text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                        -30%
                    </div>

                    <!-- Share Button -->
                    <button class="absolute top-4 left-4 bg-white bg-opacity-90 backdrop-blur hover:bg-opacity-100 p-3 rounded-full shadow-lg transition">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </button>
                </div>

                <!-- Thumbnail Images -->
                <div class="grid grid-cols-4 gap-3">
                    <button @click="mainImage = '/images/product-main.jpg'" class="aspect-square rounded-lg overflow-hidden border-2 border-indigo-600 shadow-md hover:shadow-lg transition">
                        <img src="/images/product-main.jpg" alt="View 1" class="w-full h-full object-cover">
                    </button>
                    <button @click="mainImage = '/images/product-view2.jpg'" class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200 hover:border-indigo-300 shadow-md hover:shadow-lg transition">
                        <img src="/images/product-view2.jpg" alt="View 2" class="w-full h-full object-cover">
                    </button>
                    <button @click="mainImage = '/images/product-view3.jpg'" class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200 hover:border-indigo-300 shadow-md hover:shadow-lg transition">
                        <img src="/images/product-view3.jpg" alt="View 3" class="w-full h-full object-cover">
                    </button>
                    <button @click="mainImage = '/images/product-view4.jpg'" class="aspect-square rounded-lg overflow-hidden border-2 border-gray-200 hover:border-indigo-300 shadow-md hover:shadow-lg transition">
                        <img src="/images/product-view4.jpg" alt="View 4" class="w-full h-full object-cover">
                    </button>
                </div>

                <!-- Product Highlights -->
                <div class="grid grid-cols-2 gap-3 md:gap-4">
                    <div class="bg-white rounded-xl p-4 md:p-6 shadow-md border-l-4 border-indigo-600">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.16 2.75a.75.75 0 00-1.32 0l-3.5 9.005H.75a.75.75 0 00-.712 1.05l.023.059 3.5 9.005a.75.75 0 001.32 0l3.5-9.005h2.655a.75.75 0 00.712-1.05l-.023-.059-3.5-9.005z"></path>
                            </svg>
                            <span class="font-bold text-gray-900">Premium Quality</span>
                        </div>
                        <p class="text-sm text-gray-600">Built with high-quality materials</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 md:p-6 shadow-md border-l-4 border-purple-600">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.16 2.75a.75.75 0 00-1.32 0l-3.5 9.005H.75a.75.75 0 00-.712 1.05l.023.059 3.5 9.005a.75.75 0 001.32 0l3.5-9.005h2.655a.75.75 0 00.712-1.05l-.023-.059-3.5-9.005z"></path>
                            </svg>
                            <span class="font-bold text-gray-900">2-Year Warranty</span>
                        </div>
                        <p class="text-sm text-gray-600">Full manufacturer coverage included</p>
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="space-y-6">
                <!-- Product Title & Rating -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Premium Wireless Headphones</h1>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-sm text-gray-600 ml-2">(248 reviews)</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1 bg-green-50 rounded-full border border-green-200">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium text-green-700">In Stock</span>
                        </div>
                    </div>
                </div>

                <!-- Pricing Section -->
                <div class="space-y-3 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl border border-indigo-200">
                    <div class="flex items-baseline gap-3">
                        <span class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">$249</span>
                        <span class="text-2xl text-gray-400 line-through">$359</span>
                        <span class="text-lg font-bold text-rose-600 bg-rose-50 px-3 py-1 rounded-lg">Save $110</span>
                    </div>
                    <p class="text-sm text-gray-600">Limited time offer - Offer ends in 2 days</p>
                </div>

                <!-- Product Description -->
                <div class="space-y-3">
                    <p class="text-gray-700 leading-relaxed">Experience premium audio quality with our latest wireless headphones. Featuring active noise cancellation, 30-hour battery life, and premium comfort design for all-day wear.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                            </svg>
                            <span>Active Noise Cancellation (ANC)</span>
                        </li>
                        <li class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                            </svg>
                            <span>30-Hour Battery Life</span>
                        </li>
                        <li class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path>
                            </svg>
                            <span>Premium Comfort - Foldable Design</span>
                        </li>
                    </ul>
                </div>

                <!-- Color Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Color</label>
                    <div class="flex gap-3">
                        <button @click="selectedColor = 'black'" :class="selectedColor === 'black' ? 'ring-2 ring-offset-2 ring-indigo-600' : ''" class="w-10 h-10 rounded-full bg-black shadow-md hover:shadow-lg transition border-2 border-gray-200"></button>
                        <button @click="selectedColor = 'silver'" :class="selectedColor === 'silver' ? 'ring-2 ring-offset-2 ring-indigo-600' : ''" class="w-10 h-10 rounded-full bg-gray-400 shadow-md hover:shadow-lg transition border-2 border-gray-200"></button>
                        <button @click="selectedColor = 'gold'" :class="selectedColor === 'gold' ? 'ring-2 ring-offset-2 ring-indigo-600' : ''" class="w-10 h-10 rounded-full bg-yellow-500 shadow-md hover:shadow-lg transition border-2 border-gray-200"></button>
                        <button @click="selectedColor = 'blue'" :class="selectedColor === 'blue' ? 'ring-2 ring-offset-2 ring-indigo-600' : ''" class="w-10 h-10 rounded-full bg-blue-500 shadow-md hover:shadow-lg transition border-2 border-gray-200"></button>
                    </div>
                </div>

                <!-- Size/Model Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Model</label>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="selectedSize = 'standard'" :class="selectedSize === 'standard' ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white border-indigo-600' : 'bg-white text-gray-900 border-gray-300 hover:border-indigo-300'" class="py-3 px-4 rounded-lg font-semibold border-2 transition">
                            Standard
                        </button>
                        <button @click="selectedSize = 'pro'" :class="selectedSize === 'pro' ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white border-indigo-600' : 'bg-white text-gray-900 border-gray-300 hover:border-indigo-300'" class="py-3 px-4 rounded-lg font-semibold border-2 transition">
                            Pro Edition
                        </button>
                    </div>
                </div>

                <!-- Quantity Selector -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Quantity</label>
                    <div class="flex items-center gap-4">
                        <button @click="quantity = Math.max(1, quantity - 1)" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center font-bold text-gray-700 transition">−</button>
                        <input x-model.number="quantity" type="number" min="1" class="w-16 text-center py-2 border-2 border-gray-300 rounded-lg font-bold focus:outline-none focus:border-indigo-600">
                        <button @click="quantity = quantity + 1" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center font-bold text-gray-700 transition">+</button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 pt-4">
                    <!-- Add to Cart -->
                    <button class="col-span-2 py-4 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg hover:shadow-2xl transition transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8m10 0l2 8m-12 0h12"></path>
                        </svg>
                        Add to Cart
                    </button>

                    <!-- Wishlist -->
                    <button @click="showWishlist = !showWishlist" :class="showWishlist ? 'bg-rose-100 text-rose-600 border-rose-300' : 'bg-white text-gray-700 border-gray-300 hover:border-rose-300'" class="py-4 px-6 border-2 font-bold rounded-xl transition">
                        <svg class="w-5 h-5 mx-auto" :fill="showWishlist ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Additional Info -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 pt-4 border-t-2 border-gray-200">
                    <div class="text-center py-3">
                        <p class="text-sm text-gray-600 mb-1">🚚 Free Shipping</p>
                        <p class="text-xs text-gray-500">On orders over $50</p>
                    </div>
                    <div class="text-center py-3">
                        <p class="text-sm text-gray-600 mb-1">↩️ Easy Returns</p>
                        <p class="text-xs text-gray-500">30-day return policy</p>
                    </div>
                    <div class="text-center py-3">
                        <p class="text-sm text-gray-600 mb-1">💳 Secure Payment</p>
                        <p class="text-xs text-gray-500">100% encrypted</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="max-w-7xl mx-auto">
            <!-- Tab Navigation -->
            <div class="flex flex-wrap gap-2 md:gap-6 border-b-2 border-gray-200 mb-8">
                <button @click="activeTab = 'description'" :class="activeTab === 'description' ? 'text-indigo-600 border-b-2 border-indigo-600 font-bold' : 'text-gray-600 hover:text-gray-900'" class="py-4 px-2 md:px-0 transition relative -mb-0.5">
                    Description
                </button>
                <button @click="activeTab = 'specs'" :class="activeTab === 'specs' ? 'text-indigo-600 border-b-2 border-indigo-600 font-bold' : 'text-gray-600 hover:text-gray-900'" class="py-4 px-2 md:px-0 transition relative -mb-0.5">
                    Specifications
                </button>
                <button @click="activeTab = 'reviews'" :class="activeTab === 'reviews' ? 'text-indigo-600 border-b-2 border-indigo-600 font-bold' : 'text-gray-600 hover:text-gray-900'" class="py-4 px-2 md:px-0 transition relative -mb-0.5">
                    Reviews (248)
                </button>
                <button @click="activeTab = 'qa'" :class="activeTab === 'qa' ? 'text-indigo-600 border-b-2 border-indigo-600 font-bold' : 'text-gray-600 hover:text-gray-900'" class="py-4 px-2 md:px-0 transition relative -mb-0.5">
                    Q&A
                </button>
            </div>

            <!-- Tab Content -->
            <div class="bg-white rounded-xl p-8 shadow-md">
                <!-- Description Tab -->
                <div x-show="activeTab === 'description'" class="space-y-4">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Product Description</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Experience ultimate audio excellence with our Premium Wireless Headphones. Engineered with cutting-edge technology and premium materials, these headphones deliver an unparalleled listening experience for audiophiles and casual listeners alike.
                    </p>
                    <h4 class="text-lg font-semibold text-gray-900 mt-6 mb-3">Key Features:</h4>
                    <ul class="space-y-2">
                        <li class="flex gap-3 text-gray-700">
                            <span class="text-indigo-600 font-bold">•</span>
                            <span><strong>Active Noise Cancellation:</strong> Industry-leading ANC technology blocks 99% of ambient noise</span>
                        </li>
                        <li class="flex gap-3 text-gray-700">
                            <span class="text-indigo-600 font-bold">•</span>
                            <span><strong>Extended Battery:</strong> 30-hour battery life with fast 30-minute quick charge</span>
                        </li>
                        <li class="flex gap-3 text-gray-700">
                            <span class="text-indigo-600 font-bold">•</span>
                            <span><strong>Premium Comfort:</strong> Ergonomic design with memory foam ear cushions for all-day comfort</span>
                        </li>
                        <li class="flex gap-3 text-gray-700">
                            <span class="text-indigo-600 font-bold">•</span>
                            <span><strong>Connectivity:</strong> Bluetooth 5.2 with multi-device pairing capability</span>
                        </li>
                    </ul>
                </div>

                <!-- Specifications Tab -->
                <div x-show="activeTab === 'specs'" class="space-y-4">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Specifications</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border-l-4 border-indigo-600 pl-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Audio</h4>
                            <div class="space-y-1 text-sm text-gray-700">
                                <p><strong>Frequency Response:</strong> 20Hz - 20kHz</p>
                                <p><strong>Driver Size:</strong> 40mm Dynamic</p>
                                <p><strong>Impedance:</strong> 32 Ohms</p>
                                <p><strong>Sensitivity:</strong> 105dB/mV</p>
                            </div>
                        </div>
                        <div class="border-l-4 border-purple-600 pl-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Connectivity</h4>
                            <div class="space-y-1 text-sm text-gray-700">
                                <p><strong>Bluetooth:</strong> 5.2</p>
                                <p><strong>Range:</strong> Up to 30 meters</p>
                                <p><strong>Codecs:</strong> LDAC, AAC, SBC</p>
                                <p><strong>Pairing:</strong> Multi-device (up to 8)</p>
                            </div>
                        </div>
                        <div class="border-l-4 border-rose-600 pl-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Battery</h4>
                            <div class="space-y-1 text-sm text-gray-700">
                                <p><strong>Capacity:</strong> 1000mAh</p>
                                <p><strong>Play Time:</strong> Up to 30 hours</p>
                                <p><strong>Quick Charge:</strong> 30 mins = 8 hours play</p>
                                <p><strong>Charging Time:</strong> ~2.5 hours</p>
                            </div>
                        </div>
                        <div class="border-l-4 border-pink-600 pl-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Physical</h4>
                            <div class="space-y-1 text-sm text-gray-700">
                                <p><strong>Weight:</strong> 235g</p>
                                <p><strong>Colors:</strong> Black, Silver, Gold, Blue</p>
                                <p><strong>Foldable:</strong> Yes</p>
                                <p><strong>Cable Length:</strong> 1.2m (included)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div x-show="activeTab === 'reviews'" class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h3>

                        <!-- Review Summary -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10 p-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-indigo-600">4.8</div>
                                <div class="text-yellow-400 text-lg">★★★★★</div>
                                <p class="text-xs text-gray-600 mt-1">248 reviews</p>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 text-sm mb-1">
                                    <span class="w-8">5★</span>
                                    <div class="flex-1 bg-gray-300 rounded-full h-2"><div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div></div>
                                    <span class="w-8 text-right text-gray-600">212</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm mb-1">
                                    <span class="w-8">4★</span>
                                    <div class="flex-1 bg-gray-300 rounded-full h-2"><div class="bg-blue-500 h-2 rounded-full" style="width: 12%"></div></div>
                                    <span class="w-8 text-right text-gray-600">30</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm mb-1">
                                    <span class="w-8">3★</span>
                                    <div class="flex-1 bg-gray-300 rounded-full h-2"><div class="bg-yellow-500 h-2 rounded-full" style="width: 2%"></div></div>
                                    <span class="w-8 text-right text-gray-600">4</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm mb-1">
                                    <span class="w-8">2★</span>
                                    <div class="flex-1 bg-gray-300 rounded-full h-2"><div class="bg-orange-500 h-2 rounded-full" style="width: 1%"></div></div>
                                    <span class="w-8 text-right text-gray-600">2</span>
                                </div>
                            </div>
                            <div class="col-span-2 flex flex-col gap-2">
                                <button class="py-2 px-4 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                                    Write a Review
                                </button>
                                <button class="py-2 px-4 border-2 border-indigo-600 text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition">
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
                                        <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full">
                                        <div>
                                            <p class="font-semibold text-gray-900">John Mitchell</p>
                                            <p class="text-xs text-gray-500">Verified Purchase • 2 weeks ago</p>
                                        </div>
                                    </div>
                                    <span class="text-yellow-400">★★★★★</span>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Best headphones I've ever owned!</h4>
                                <p class="text-gray-700 mb-3">The sound quality is exceptional, and the noise cancellation is incredibly effective. Battery life easily gets me through 5-6 days of use. Highly recommend!</p>
                                <div class="flex gap-3">
                                    <button class="text-sm text-gray-600 hover:text-indigo-600 transition flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.359 6.718A2 2 0 0115.406 24H4m-5-8h16m0 0a2 2 0 110-4H3"></path>
                                        </svg>
                                        Helpful
                                    </button>
                                </div>
                            </div>

                            <!-- Review 2 -->
                            <div class="pb-6 border-b border-gray-200">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full">
                                        <div>
                                            <p class="font-semibold text-gray-900">Sarah Anderson</p>
                                            <p class="text-xs text-gray-500">Verified Purchase • 1 month ago</p>
                                        </div>
                                    </div>
                                    <span class="text-yellow-400">★★★★★</span>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Premium quality at a great price</h4>
                                <p class="text-gray-700 mb-3">Exceeded my expectations in every way. The comfort is outstanding even for extended listening sessions. Worth every penny!</p>
                                <div class="flex gap-3">
                                    <button class="text-sm text-gray-600 hover:text-indigo-600 transition flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.359 6.718A2 2 0 0115.406 24H4m-5-8h16m0 0a2 2 0 110-4H3"></path>
                                        </svg>
                                        Helpful
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Show More Reviews Button -->
                        <button class="w-full py-3 mt-6 border-2 border-indigo-600 text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition">
                            Load More Reviews
                        </button>
                    </div>
                </div>

                <!-- Q&A Tab -->
                <div x-show="activeTab === 'qa'" class="space-y-4">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Questions & Answers</h3>

                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-semibold text-gray-900">Q: Are these compatible with iOS and Android?</p>
                                    <p class="text-xs text-gray-500 mt-1">Asked by Michael Chen • 3 days ago</p>
                                </div>
                                <span class="text-sm text-green-600 font-semibold">✓ Answered</span>
                            </div>
                            <p class="text-gray-700 mt-3 ml-4 pl-4 border-l-2 border-green-500">A: Yes! These headphones are fully compatible with all devices that support Bluetooth 5.2, including iOS, Android, macOS, Windows, and more.</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-semibold text-gray-900">Q: What's included in the box?</p>
                                    <p class="text-xs text-gray-500 mt-1">Asked by Emma Wilson • 1 week ago</p>
                                </div>
                                <span class="text-sm text-green-600 font-semibold">✓ Answered</span>
                            </div>
                            <p class="text-gray-700 mt-3 ml-4 pl-4 border-l-2 border-green-500">A: The package includes: Headphones, USB-C charging cable, 3.5mm audio cable, carrying case, 3 pairs of ear cushion sizes, and user manual.</p>
                        </div>
                    </div>

                    <button class="w-full py-3 mt-6 border-2 border-indigo-600 text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition">
                        Ask a Question
                    </button>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <div class="max-w-7xl mx-auto mt-20">
            <div class="mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">You Might Also Like</h2>
                <p class="text-gray-600">Discover other premium audio products</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden relative">
                        <img src="https://via.placeholder.com/300" alt="Product" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-3 right-3 bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold">-25%</div>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-500 mb-1">Wireless Earbuds</p>
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">Premium True Wireless Earbuds</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-xs text-gray-500">(142)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-indigo-600">$79</span>
                            <span class="text-lg text-gray-400 line-through">$105</span>
                        </div>
                        <button class="w-full py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition">
                            Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden relative">
                        <img src="https://via.placeholder.com/300" alt="Product" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-3 right-3 bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold">-20%</div>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-500 mb-1">Portable Speaker</p>
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">Waterproof Mini Bluetooth Speaker</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-yellow-400">★★★★☆</span>
                            <span class="text-xs text-gray-500">(89)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-indigo-600">$35</span>
                            <span class="text-lg text-gray-400 line-through">$44</span>
                        </div>
                        <button class="w-full py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition">
                            Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden relative">
                        <img src="https://via.placeholder.com/300" alt="Product" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-3 right-3 bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold">-35%</div>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-500 mb-1">Audio Cables</p>
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">Premium Gold Plated Audio Cable</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-xs text-gray-500">(156)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-indigo-600">$13</span>
                            <span class="text-lg text-gray-400 line-through">$20</span>
                        </div>
                        <button class="w-full py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition">
                            Add to Cart
                        </button>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden relative">
                        <img src="https://via.placeholder.com/300" alt="Product" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute top-3 right-3 bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold">-15%</div>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-500 mb-1">Cases & Covers</p>
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">Premium Protective Headphone Case</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-xs text-gray-500">(67)</span>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-indigo-600">$24</span>
                            <span class="text-lg text-gray-400 line-through">$28</span>
                        </div>
                        <button class="w-full py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
