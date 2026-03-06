<div>
    <aside id="sidebar"
        class="fixed md:static left-0 top-0 h-full w-64 bg-gradient-to-b from-white via-indigo-50 to-gray-50 text-gray-900 shadow-lg transform -translate-x-full md:translate-x-0 transition-transform z-40">
        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3 hover:opacity-80 transition px-8 py-4"
            wire:navigate>
            <div
                class="w-12 h-12 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded-lg flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white"
                    stroke="white" stroke-width="1.5">
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
        <hr>



        <nav class="flex-1 p-4 space-y-2" x-data="{ productsOpen: true, ordersOpen: true }">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ Request::segment(2) === 'dashboard' ? 'bg-indigo-100 text-[#0b7a93] font-semibold' : '' }} hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m-9-3l4 4" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Products Dropdown -->
            <div>
                <button
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ in_array(Request::segment(2), ['product', 'category', 'sub-category', 'brand', 'color']) ? 'bg-gradient-to-r from-indigo-100 to font-semibold shadow-sm border-l-4 border-[#0b7a93]' : 'border-l-4 border-transparent hover:bg-gray-100' }} transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m0 0l8-4m0 0l8 4m0 0v10l-8 4m0-10L4 7m8 4v10m0-10l8 4m-8-4l-8 4" />
                    </svg>
                    <span class="flex-1 text-left font-medium">Products</span>

                </button>

                <!-- Products Submenu -->
                <div x-show="productsOpen" x-transition
                    class="ml-4 mt-2 space-y-1 border-l-4 border-indigo-400 pl-3 py-2">
                    <a href="{{ route('admin.product') }}" wire:navigate
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 text-sm font-medium {{ Request::segment(2) === 'product' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }} transition transform hover:translate-x-1">

                        <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7L12 3 4 7m16 0v10l-8 4m8-14l-8 4m0 0L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span>All Products</span>
                    </a>

                    <a href="{{ route('admin.category') }}" wire:navigate
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 text-sm font-medium {{ Request::segment(2) === 'category' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }} transition transform hover:translate-x-1">
                        <svg class="w-4 h-4 {{ Request::segment(2) === 'category' ? 'text-[#0b7a93]' : 'text-[#0b7a93]' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485" />
                        </svg>
                        <span>Category</span>
                    </a>
                    <a href="{{ route('admin.sub-category') }}" wire:navigate
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 text-sm font-medium {{ Request::segment(2) === 'sub-category' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }} transition transform hover:translate-x-1">
                        <svg class="w-4 h-4 {{ Request::segment(2) === 'sub-category' ? 'text-[#0b7a93]' : 'text-[#0b7a93]' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" />
                        </svg>
                        <span>Sub Category</span>
                    </a>
                    <a href="{{ route('admin.brand') }}" wire:navigate
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 text-sm font-medium {{ Request::segment(2) === 'brand' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }} transition transform hover:translate-x-1">
                        <svg class="w-4 h-4 {{ Request::segment(2) === 'brand' ? 'text-[#0b7a93]' : 'text-[#0b7a93]' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span>Brands</span>
                    </a>

                    <a href="{{ route('admin.color') }}" wire:navigate
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 text-sm font-medium {{ Request::segment(2) === 'color' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }} transition transform hover:translate-x-1">
                        <div
                            class="w-4 h-4 rounded-full {{ Request::segment(2) === 'color' ? 'bg-[#0b7a93]' : 'bg-[#0b7a93]' }}">
                        </div>
                        <span>Colors</span>
                    </a>

                    <a href="{{ route('admin.discountCode') }}" wire:navigate
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 text-sm font-medium {{ Request::segment(2) === 'discount-code' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }} transition transform hover:translate-x-1">

                        <svg class="w-4 h-4 fill-none stroke-current {{ Request::segment(2) === 'discount-code' ? 'text-[#0b7a93]' : 'text-[#0b7a93]' }}"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 14l6-6M9 8h.01M15 16h.01M7 7h10a2 2 0 012 2v2a2 2 0 010 4v2a2 2 0 01-2 2H7a2 2 0 01-2-2v-2a2 2 0 010-4V9a2 2 0 012-2z" />
                        </svg>
                        <span>Discount Code</span>
                    </a>


                    <a href="{{ route('admin.shipping-method') }}" wire:navigate
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 text-sm font-medium {{ Request::segment(2) === 'shipping-method' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }} transition transform hover:translate-x-1">

                        <svg class="w-4 h-4 fill-none stroke-current  {{ Request::segment(2) === 'shipping-method' ? 'text-[#0b7a93]' : 'text-[#0b7a93]' }}"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17h6m-9 0H5a2 2 0 01-2-2V7a2 2 0 012-2h11a2 2 0 012 2v3h2l2 3v2a2 2 0 01-2 2h-1m-12 0a2 2 0 104 0m6 0a2 2 0 104 0" />
                        </svg>
                        <span>Shipping Method</span>
                    </a>


                </div>

                <!-- Orders Dropdown -->
                <div class="mt-2">
                    <button @click="ordersOpen = !ordersOpen"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ in_array(Request::segment(2), ['order-list']) ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] font-semibold shadow-sm border-l-4 border-[#0b7a93]' : 'border-l-4 border-transparent hover:bg-gray-100' }} transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="flex-1 text-left font-medium">Orders</span>
                    </button>

                    <!-- Orders Submenu -->
                    <div x-show="ordersOpen" x-transition class="ml-4 mt-2 space-y-1  pl-3 py-2">

                        <a href="{{ route('admin.orderList') }}" wire:naviage
                            class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 text-sm font-medium {{ Request::segment(2) === 'order-list' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }} transition transform hover:translate-x-1">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>All Orders</span>
                        </a>

                    </div>
                </div>



                <a href="{{ route('admin.HeroSlider') }}" wire:navigate
                    class="flex items-center gap-3 px-4 py-2
                    rounded-lg text-gray-600 text-sm font-medium
                    {{ Request::segment(2) === 'hero-slider' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }}
                    transition transform hover:translate-x-1">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                    <span>Hero Slider</span>
                </a>



                <a href="{{ route('admin.customers') }}" wire:navigate
                    class="flex items-center gap-3 px-4 py-2
                    rounded-lg text-gray-600 text-sm font-medium
                    {{ Request::segment(2) === 'customers' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }}
                    transition transform hover:translate-x-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 8.048 4 4 0 010-8.048z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14H5v3a4 4 0 004 4h6a4 4 0 004-4v-3z" />
                    </svg>
                    <span>Customers</span>
                </a>

                <a href="{{ route('admin.paymentSetting') }}" wire:navigate
                    class="flex items-center gap-3 px-4 py-2
                    rounded-lg text-gray-600 text-sm font-medium
                    {{ Request::segment(2) === 'payment-setting' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }}
                    transition transform hover:translate-x-1">
                    <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h18M3 10h18M5 15h4m-6 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Payment Setting</span>
                </a>

                <a href="{{ route('admin.SMTPSetting') }}" wire:navigate
                    class="flex items-center gap-3 px-4 py-2
                    rounded-lg text-gray-600 text-sm font-medium
                    {{ Request::segment(2) === 'smtp-setting' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }}
                    transition transform hover:translate-x-1">
                    <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>SMTP Setting</span>
                </a>

                <a href="{{ route('admin.systemSetting') }}" wire:navigate
                    class="flex items-center gap-3 px-4 py-2
                    rounded-lg text-gray-600 text-sm font-medium
                    {{ Request::segment(2) === 'system-setting' ? 'bg-gradient-to-r from-indigo-100 to-purple-100 text-[#0b7a93] shadow-sm border-l-2 border-[#0b7a93]' : 'hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-[#0b7a93] hover:shadow-sm' }}
                    transition transform hover:translate-x-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </a>
        </nav>

        <div class="p-4 border-t border-gray-200">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition w-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>


</div>
