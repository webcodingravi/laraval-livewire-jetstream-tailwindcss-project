<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:relative lg:z-0">
        <!-- Logo Section -->
        <div class="flex items-center justify-between p-6 border-b border-blue-500">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <button id="close-sidebar" class="lg:hidden text-white hover:bg-blue-700 p-2 rounded">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-6 space-y-2">
            <a href="#"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4"></path>
                </svg>
                <span>Home</span>
            </a>

            <a href="#"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Profile</span>
            </a>

            <a href="#"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span>Orders</span>
            </a>

            <a href="#"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Settings</span>
            </a>

            <a href="#"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                <span>Logout</span>
            </a>
        </nav>

        <!-- Additional Info -->
        <div class="absolute bottom-0 w-full p-6 border-t border-blue-500 bg-blue-700">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-sm font-bold">
                    U
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold">User Name</p>
                    <p class="text-xs text-blue-200">user@example.com</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navigation Bar -->
        <header class="bg-white shadow-md z-40">
            <div class="px-6 py-4 flex items-center justify-between">
                <!-- Mobile Menu Button -->
                <button id="open-sidebar"
                    class="lg:hidden text-gray-600 hover:text-gray-900 p-2 rounded hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h2 class="text-xl font-semibold text-gray-800">Welcome to Your Dashboard</h2>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-600 hover:text-gray-900 p-2 rounded hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                    </button>
                    <button
                        class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold hover:bg-blue-600">
                        U
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Welcome Card -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Hello, User!</h3>
                    <p class="text-gray-600">Welcome back to your dashboard. Here you can manage your profile, orders,
                        and preferences.</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Stat Card 1 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-full p-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Total Orders</p>
                                <p class="text-2xl font-bold text-gray-800">24</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="bg-green-100 rounded-full p-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Total Spent</p>
                                <p class="text-2xl font-bold text-gray-800">$2,450</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="bg-purple-100 rounded-full p-4">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Messages</p>
                                <p class="text-2xl font-bold text-gray-800">5</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center">
                            <div class="bg-orange-100 rounded-full p-4">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Last Activity</p>
                                <p class="text-2xl font-bold text-gray-800">2h ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800">Recent Orders</h4>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Order ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Product</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Amount</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-800">#ORD001</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">Laptop</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">$1,200</td>
                                    <td class="px-6 py-4 text-sm"><span
                                            class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Delivered</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Jan 15, 2026</td>
                                </tr>
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-800">#ORD002</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">Mouse</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">$45</td>
                                    <td class="px-6 py-4 text-sm"><span
                                            class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Feb 10, 2026</td>
                                </tr>
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-800">#ORD003</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">Keyboard</td>
                                    <td class="px-6 py-4 text-sm text-gray-800">$120</td>
                                    <td class="px-6 py-4 text-sm"><span
                                            class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">Processing</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Feb 20, 2026</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>



    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <script>
        // Get elements
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');
        const overlay = document.getElementById('overlay');

        // Open sidebar
        openBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        // Close sidebar
        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Close sidebar when overlay clicked
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
</div>
