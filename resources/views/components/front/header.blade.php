<div x-data="ecommerceHeader()" x-cloak>
    <!-- Top Bar - Promo/Info -->

    <!-- Main Navigation Header -->
    <nav class="fixed top-0 w-full bg-white z-[999] transition-all shadow">
        <div class="w-11/12 mx-auto py-4">
            <!-- Top Row: Logo, Search, Icons -->
            <div class="flex items-center justify-between gap-4 mb-3">
                <!-- Logo with Brand Name -->
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3 hover:opacity-80 transition">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="white" stroke="white" stroke-width="1.5">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                    <div class="sm:block">
                        <h1
                            class="text-xl font-bold bg-gradient-to-r from-[#24bad8] to-[#0b7a93] bg-clip-text text-transparent">
                            ShopHub</h1>
                        <p class="text-xs text-gray-500">Online Store</p>
                    </div>
                </a>

                <div class="hidden md:flex items-center justify-center gap-5 flex-1 mx-w-2xl">
                    <a href="#"
                        class="px-4 py-2 text-gray-700 hover:text-[#0b7a93] transition font-medium text-md">Home</a>

                    <a href="#"
                        class="px-4 py-2 text-gray-700 hover:text-indigo-600  transition font-medium text-md flex items-center gap-1">
                        About Us
                    </a>

                    <!-- Categories Mega Menu -->
                    <div class="relative group">
                        <button
                            class="px-4 py-2 text-gray-700 hover:text-indigo-600 transition font-medium text-md flex items-center gap-1">
                            Shop
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <!-- Mega Menu Dropdown -->
                        <div class="absolute left-0 mt-0 w-screen max-w-3xl bg-white border-t-4 border-indigo-600 rounded-lg shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50"
                            style="left: 50%; transform: translateX(-50%);">
                            <div class="grid grid-cols-4 gap-6 p-6">
                                <!-- Column 1 -->
                                <div>
                                    <h3 class="font-bold text-gray-800 mb-3 text-md">Electronics</h3>
                                    <ul class="space-y-2 text-sm">
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Laptops</a></li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Smartphones</a>
                                        </li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Tablets</a></li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Cameras</a></li>
                                    </ul>
                                </div>
                                <!-- Column 2 -->
                                <div>
                                    <h3 class="font-bold text-gray-800 mb-3 text-md">Fashion</h3>
                                    <ul class="space-y-2 text-sm">
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Men's
                                                Clothing</a></li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Women's
                                                Clothing</a>
                                        </li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Shoes</a></li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Accessories</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Column 3 -->
                                <div>
                                    <h3 class="font-bold text-gray-800 mb-3 text-md">Home & Garden</h3>
                                    <ul class="space-y-2 text-sm">
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Furniture</a>
                                        </li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Bedding</a></li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Kitchen</a></li>
                                        <li><a href="#"
                                                class="text-gray-600 hover:text-indigo-600 transition">Outdoor</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>




                    <a href="#"
                        class="px-4 py-2 text-gray-700 hover:text-indigo-600 transition font-medium text-md">Contact</a>
                </div>

                <!-- Search Bar - Hidden on Mobile -->
                <div class="hidden lg:flex items-center justify-center w-full max-w-md">
                    <form class="w-full relative ">
                        <input type="text" placeholder="Search for products, brands, and more..."
                            class="w-full px-5 py-4 rounded-full border-2 border-gray-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 text-sm transition">
                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-indigo-600 hover:text-indigo-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </form>
                </div>


                <!-- Right Icons -->
                <div class="flex items-center md:gap-4">
                    <!-- Wishlist -->
                    <a href="#"
                        class="relative p-2 md:p-3 text-gray-700 hover:text-red-500 hover:bg-red-50 rounded-full transition"
                        title="Wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </a>

                    <!-- Shopping Cart -->
                    <a href="#"
                        class="relative p-2 md:p-3 text-gray-700 hover:text-[#0b7a93] hover:bg-indigo-50 rounded-full transition"
                        title="Cart">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span
                            class="absolute -top-1 -right-1 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">5</span>
                    </a>

                    <!-- User Account Dropdown -->
                    @if (Auth::check())
                        <div class="relative hidden md:block">
                            <button @click="userOpen = !userOpen"
                                class="flex items-center gap-2 p-2 md:p-3 text-gray-700 hover:text-[#24bad8] hover:bg-indigo-50 rounded-full transition">
                                <div
                                    class="w-10 h-10 md:-mt-3 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    :class="{ 'rotate-180': userOpen }">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div x-show="userOpen" @click.outside="userOpen = false"
                                class="absolute right-0 mt-2 w-56 bg-white border-2 border-gray-100 rounded-xl shadow-xl overflow-hidden z-50"
                                style="display:none;">
                                <div class="bg-gradient-to-r from-[#24bad8] to-[#0b7a93] px-4 py-3">
                                    <p class="text-white font-semibold">{{ Auth::user()->name }}</p>
                                    <p class="text-indigo-100 text-sm">{{ Auth::user()->email ?? 'user@example.com' }}
                                    </p>
                                </div>
                                <a href="/dashboard"
                                    class="px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="#"
                                    class="px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                        </path>
                                    </svg>
                                    My Orders
                                </a>
                                <a href="#"
                                    class="px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                    Wishlist
                                </a>
                                <a href="#"
                                    class="px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                    Settings
                                </a>
                                <hr class="my-1 border-gray-100">
                                <form action="{{ route('logout') }}" method="post" class="block">
                                    @csrf
                                    <button
                                        class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12">
                                            </line>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="hidden md:flex gap-2">
                            <a href="/login"
                                class="px-4 py-2 text-md font-medium text-[#0b7a93] hover:bg-indigo-50 rounded-lg transition">
                                Login
                            </a>
                            <a href="/register"
                                class="px-4 py-2 bg-gradient-to-r from-[#24bad8] to-[#0b7a93] text-white text-md font-medium rounded-lg hover:shadow-lg transition">
                                Register
                            </a>
                        </div>
                    @endif

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-full transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Search Bar -->
            <div class="lg:hidden mb-3">
                <form class="relative">
                    <input type="text" placeholder="Search..."
                        class="w-full px-4 py-4 rounded-lg border-2 border-gray-200 focus:border-indigo-500 focus:outline-none text-sm">
                    <button type="submit"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                </form>
            </div>


        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false"
            class="md:hidden bg-white border-t border-gray-200 max-h-[calc(100vh-80px)] overflow-y-auto"
            style="display:none;">
            <div class="p-4 space-y-1">
                <a href="#"
                    class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg transition font-medium">Home</a>

                <a href="#"
                    class="block px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition font-bold">About Us
                </a>

                <!-- Mobile Categories Accordion -->
                <div>
                    <button @click="categoriesOpen = !categoriesOpen"
                        class="w-full text-left px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg transition font-medium flex items-center justify-between">
                        Categories
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" :class="{ 'rotate-180': categoriesOpen }">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div x-show="categoriesOpen" class="pl-4 space-y-2 border-l-2 border-indigo-200"
                        style="display:none;">
                        <div>
                            <p class="font-semibold text-gray-700 text-sm mt-3 mb-2">Electronics</p>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 transition">Laptops</a>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 transition">Smartphones</a>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 transition">Tablets</a>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 text-sm mt-3 mb-2">Fashion</p>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 transition">Men's</a>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 transition">Women's</a>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 transition">Shoes</a>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700 text-sm mt-3 mb-2">Home & Garden</p>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 transition">Furniture</a>
                            <a href="#"
                                class="block px-3 py-2 text-sm text-gray-600 hover:text-indigo-600 transition">Bedding</a>
                        </div>
                    </div>
                </div>


                <a href="#"
                    class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 rounded-lg transition font-medium">Contact</a>

                <hr class="my-4 border-gray-200">

                <!-- Mobile Auth Section -->
                @if (Auth::check())
                    <div class="space-y-2 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-600">Logged in</p>
                            </div>
                        </div>
                        <a href="/dashboard"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-100 rounded transition mt-2">Dashboard</a>
                        <a href="#"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-100 rounded transition">My
                            Orders</a>
                        <a href="#"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-100 rounded transition">Wishlist</a>
                        <a href="#"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-100 rounded transition">Settings</a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button
                                class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-100 rounded transition">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="space-y-2">
                        <a href="/login"
                            class="block px-4 py-3 text-sm text-[#0b7a93]  border-2 border-[#0b7a93] rounded-lg hover:bg-indigo-50 transition text-center font-medium">
                            Login
                        </a>
                        <a href="/register"
                            class="block px-4 py-3 bg-gradient-to-r from-[#24bad8] to-[#0b7a93] text-white text-sm rounded-lg hover:shadow-lg transition text-center font-medium">
                            Register
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Alpine.js Component Script -->
    @push('script')
        <script>
            function ecommerceHeader() {
                return {
                    mobileMenuOpen: false,
                    categoriesOpen: false,
                    userOpen: false,
                    showCurrency: false,
                }
            }
        </script>
    @endpush
</div>
