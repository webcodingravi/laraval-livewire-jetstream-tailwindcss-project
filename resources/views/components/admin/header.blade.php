<div>
    <header class="bg-white shadow-sm">
        <div class="flex items-center justify-between h-16 px-4 md:px-6">
            <button onclick="toggleSidebar()" class="md:hidden p-2 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="flex-1 max-w-md mx-4">
            </div>

            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <div class="relative hidden sm:block">
                    <button class="relative p-2 hover:bg-gray-100 rounded-lg">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                    </button>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative group flex items-center gap-3 pl-4 border-l border-gray-200">
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-medium text-gray-900">
                            {{ Auth::user()->fullname }}
                        </p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>

                    <button
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-[#24bad8] to-[#0b7a93] active:scale-95 duration-300 flex items-center justify-center text-white font-bold hover:shadow-lg transition">
                        @if (!empty(Auth::user()->profile_photo_path))
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile"
                                class="w-full h-full rounded-full object-cover">
                        @else
                            {{ strtoupper(Auth::user()->first_name[0] ?? 'A') }}
                        @endif


                    </button>


                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 mt-[140px] w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden group-hover:block z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->fullname }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('admin.account-setting') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">⚙️ Account
                            Settings</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">🚪
                                Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
