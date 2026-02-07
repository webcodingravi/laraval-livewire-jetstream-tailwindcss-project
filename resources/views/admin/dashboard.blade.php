<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Title -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Dashboard</h2>
            <p class="text-gray-600 mt-1">Welcome back, Admin!</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            <!-- Total Sales -->
            <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Sales</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">$12,540</p>
                        <p class="text-green-600 text-sm mt-2">↑ 12% from last month</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Orders</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">1,847</p>
                        <p class="text-green-600 text-sm mt-2">↑ 8% from last month</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Active Users</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">2,356</p>
                        <p class="text-green-600 text-sm mt-2">↑ 5% from last month</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 8.048 4 4 0 010-8.048z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14H5v3a4 4 0 004 4h6a4 4 0 004-4v-3z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Conversion Rate -->
            <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Conversion Rate</p>
                        <p class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">3.28%</p>
                        <p class="text-green-600 text-sm mt-2">↑ 2% from last month</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
            <!-- Sales Chart -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Sales Overview</h3>
                    <select
                        class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 90 days</option>
                    </select>
                </div>
                <div
                    class="h-64 bg-gradient-to-b from-indigo-50 to-gray-50 rounded-lg flex items-end justify-around p-4">
                    <div class="w-8 h-32 bg-indigo-500 rounded-t-lg"></div>
                    <div class="w-8 h-40 bg-indigo-500 rounded-t-lg"></div>
                    <div class="w-8 h-28 bg-indigo-500 rounded-t-lg"></div>
                    <div class="w-8 h-44 bg-indigo-500 rounded-t-lg"></div>
                    <div class="w-8 h-36 bg-indigo-500 rounded-t-lg"></div>
                    <div class="w-8 h-48 bg-indigo-500 rounded-t-lg"></div>
                    <div class="w-8 h-40 bg-indigo-500 rounded-t-lg"></div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Top Products</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Laptop Pro 15"</span>
                        <span class="text-sm font-semibold text-gray-900">450</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-indigo-500 h-2 rounded-full" style="width: 90%"></div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="text-sm text-gray-600">Wireless Mouse</span>
                        <span class="text-sm font-semibold text-gray-900">380</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 76%"></div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="text-sm text-gray-600">USB Hub</span>
                        <span class="text-sm font-semibold text-gray-900">290</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: 58%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Recent Orders</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b border-gray-200">
                        <tr>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Order ID</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Customer</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Amount</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 text-gray-900">#10234</td>
                            <td class="py-3 px-4 text-gray-600">John Doe</td>
                            <td class="py-3 px-4 text-gray-900 font-semibold">$1,240</td>
                            <td class="py-3 px-4">
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Completed</span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">Jan 28, 2026</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 text-gray-900">#10233</td>
                            <td class="py-3 px-4 text-gray-600">Jane Smith</td>
                            <td class="py-3 px-4 text-gray-900 font-semibold">$856</td>
                            <td class="py-3 px-4">
                                <span
                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Pending</span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">Jan 27, 2026</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 text-gray-900">#10232</td>
                            <td class="py-3 px-4 text-gray-600">Mike Johnson</td>
                            <td class="py-3 px-4 text-gray-900 font-semibold">$2,145</td>
                            <td class="py-3 px-4">
                                <span
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Processing</span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">Jan 26, 2026</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 text-gray-900">#10231</td>
                            <td class="py-3 px-4 text-gray-600">Sarah Williams</td>
                            <td class="py-3 px-4 text-gray-900 font-semibold">$945</td>
                            <td class="py-3 px-4">
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Completed</span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">Jan 25, 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
