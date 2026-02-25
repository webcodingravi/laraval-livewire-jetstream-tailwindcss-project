<div>
    <div class="mt-[100px]">

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total Orders Card -->
                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Total Orders</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-slate-500 text-xs mt-4">View your complete order history</p>
                </div>

                <!-- Total Spent Card -->
                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Total Spent</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">$0.00</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-slate-500 text-xs mt-4">Lifetime spending on our store</p>
                </div>

                <!-- Wishlist Card -->
                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Wishlist Items</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-slate-500 text-xs mt-4">Items saved for later</p>
                </div>

                <!-- Reward Points Card -->
                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-amber-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Reward Points</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
                        </div>
                        <div class="bg-amber-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-slate-500 text-xs mt-4">Earn on every purchase</p>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Recent Orders & Wishlist -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Recent Orders Section -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-slate-900">Recent Orders</h2>
                            <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                        </div>

                        <!-- Orders Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-slate-200">
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Order ID</th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Date</th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Total</th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                                        <td class="py-4 px-4 text-slate-900 font-medium">#ORD-001</td>
                                        <td class="py-4 px-4 text-slate-600">Feb 20, 2026</td>
                                        <td class="py-4 px-4 text-slate-900 font-medium">$129.99</td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Delivered
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                                        <td class="py-4 px-4 text-slate-900 font-medium">#ORD-002</td>
                                        <td class="py-4 px-4 text-slate-600">Feb 15, 2026</td>
                                        <td class="py-4 px-4 text-slate-900 font-medium">$89.50</td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                In Transit
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-4 px-4 text-slate-900 font-medium">#ORD-003</td>
                                        <td class="py-4 px-4 text-slate-600">Feb 10, 2026</td>
                                        <td class="py-4 px-4 text-slate-900 font-medium">$249.99</td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Delivered
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div class="text-center py-12" style="display: none;">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <p class="mt-4 text-slate-600">No orders yet</p>
                            <a href="#" class="text-blue-600 hover:text-blue-700 mt-2 inline-block">Start
                                Shopping</a>
                        </div>
                    </div>

                    <!-- Wishlist Section -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-slate-900">Your Wishlist</h2>
                            <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View
                                All</a>
                        </div>

                        <!-- Wishlist Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Wishlist Item -->
                            <div
                                class="border border-slate-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow group">
                                <div class="bg-slate-200 h-32 relative overflow-hidden">
                                    <img src="https://via.placeholder.com/200x150?text=Product" alt="Product"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                    <button
                                        class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white p-2 rounded-full">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-4">
                                    <p class="text-slate-600 text-xs mb-1">Electronics</p>
                                    <h3 class="font-semibold text-slate-900 text-sm mb-2">Wireless Headphones</h3>
                                    <p class="text-lg font-bold text-slate-900">$59.99</p>
                                    <button
                                        class="mt-3 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm font-medium transition">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>

                            <!-- Empty Wishlist State -->
                        </div>

                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                </path>
                            </svg>
                            <p class="mt-4 text-slate-600">Your wishlist is empty</p>
                            <a href="#" class="text-blue-600 hover:text-blue-700 mt-2 inline-block">Browse
                                Products</a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Account Management -->
                <div class="space-y-6">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Account Details</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-slate-600 uppercase tracking-wide">Full Name</p>
                                <p class="text-slate-900 font-medium">{{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 uppercase tracking-wide">Email</p>
                                <p class="text-slate-900 font-medium">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 uppercase tracking-wide">Phone</p>
                                <p class="text-slate-900 font-medium">{{ Auth::user()->phone_number ?? 'Not set' }}</p>
                            </div>
                            <div class="pt-2 border-t border-slate-200">
                                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Edit
                                    Profile</a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Links</h3>
                        <div class="space-y-2">
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm font-medium">My Addresses</span>
                            </a>
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700">
                                <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10a4 4 0 014-4h10a4 4 0 014 4v7a4 4 0 01-4 4H7a4 4 0 01-4-4v-7z"></path>
                                </svg>
                                <span class="text-sm font-medium">Payment Methods</span>
                            </a>
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium">Order History</span>
                            </a>
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700">
                                <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium">Notifications</span>
                            </a>
                        </div>
                    </div>

                    <!-- Account Settings -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Settings</h3>
                        <div class="space-y-2">
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700">
                                <svg class="w-5 h-5 text-slate-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm font-medium">Account Settings</span>
                            </a>
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700">
                                <svg class="w-5 h-5 text-slate-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium">Change Password</span>
                            </a>
                            <a href="#"
                                class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700">
                                <svg class="w-5 h-5 text-slate-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium">Two-Factor Auth</span>
                            </a>
                        </div>
                    </div>

                    <!-- Support -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 border border-blue-200">
                        <h3 class="text-lg font-bold text-blue-900 mb-2">Need Help?</h3>
                        <p class="text-blue-800 text-sm mb-4">Can't find what you're looking for?</p>
                        <button
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm font-medium transition">
                            Contact Support
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
