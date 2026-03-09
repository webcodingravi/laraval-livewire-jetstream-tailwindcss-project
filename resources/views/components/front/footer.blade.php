<footer class="relative w-full bg-gradient-to-b from-gray-900 via-slate-900 to-gray-950 text-gray-300">
    <!-- Decorative Top Border -->
    <div class="h-1 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600"></div>

    <!-- Main Footer Content -->
    <div class="px-4 md:px-8 lg:px-16 xl:px-24 py-16 md:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 md:gap-12 mb-12">
            <!-- Brand Section -->
            <div class="lg:col-span-1 md:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <a href="{{ route('home') }}" wire:navigate>
                        {{-- {{ $setting }} --}}
                        @if (!empty($setting->logo))
                            <img src="{{ asset('storage/uploads/settings/' . $setting->logo) }}" />
                        @elseif(!empty($setting->website_name))
                            <h1
                                class="text-xl font-bold bg-gradient-to-r from-[#24bad8] to-[#0b7a93] bg-clip-text text-transparent">
                                {{ $setting->website_name }}</h1>
                        @endif

                    </a>
                    {{-- <a href="{{ route('home') }}"
                        class="flex-shrink-0 flex items-center gap-3 hover:opacity-80 transition" wire:navigate>
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
                    </a> --}}

                </div>
                <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                    {{ $setting->footer_description ?? '' }}
                    {{-- Your trusted destination for quality products and exceptional service. Shop with confidence and
                    discover amazing deals every day. --}}
                </p>
                <!-- Social Links -->
                <div class="flex items-center gap-4">

                    @if (!empty($setting->facebook_link))
                        <a href="{{ $setting->facebook_link }}"
                            class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                    @endif

                    @if (!empty($setting->twitter_link))
                        <a href="{{ $setting->twitter_link }}"
                            class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7-7 7-7z" />
                            </svg>
                        </a>
                    @endif

                    @if (!empty($setting->instagram_link))
                        <a href="{{ $setting->instagram_link }}"
                            class="w-10 h-10 bg-gray-800 hover:bg-indigo-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                                fill="currentColor" fill="currentColor">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.056 1.97.246 2.428.413a4.92 4.92 0 011.675 1.09 4.92 4.92 0 011.09 1.675c.167.458.357 1.258.413 2.428.058 1.266.07 1.645.07 4.85s-.012 3.584-.07 4.85c-.056 1.17-.246 1.97-.413 2.428a4.902 4.902 0 01-1.09 1.675 4.902 4.902 0 01-1.675 1.09c-.458.167-1.258.357-2.428.413-1.266.058-1.645.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.056-1.97-.246-2.428-.413a4.902 4.902 0 01-1.675-1.09 4.902 4.902 0 01-1.09-1.675c-.167-.458-.357-1.258-.413-2.428C2.175 15.747 2.163 15.368 2.163 12s.012-3.584.07-4.85c.056-1.17.246-1.97.413-2.428a4.902 4.902 0 011.09-1.675 4.902 4.902 0 011.675-1.09c.458-.167 1.258-.357 2.428-.413C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.013 7.052.072 5.78.131 4.842.312 4.042.625a6.92 6.92 0 00-2.5 1.64A6.92 6.92 0 00.625 4.042C.312 4.842.131 5.78.072 7.052.013 8.332 0 8.741 0 12s.013 3.668.072 4.948c.059 1.272.24 2.21.553 3.01a6.92 6.92 0 001.64 2.5 6.92 6.92 0 002.5 1.64c.8.313 1.738.494 3.01.553C8.332 23.987 8.741 24 12 24s3.668-.013 4.948-.072c1.272-.059 2.21-.24 3.01-.553a6.92 6.92 0 002.5-1.64 6.92 6.92 0 001.64-2.5c.313-.8.494-1.738.553-3.01.059-1.28.072-1.689.072-4.948s-.013-3.668-.072-4.948c-.059-1.272-.24-2.21-.553-3.01a6.92 6.92 0 00-1.64-2.5 6.92 6.92 0 00-2.5-1.64c-.8-.313-1.738-.494-3.01-.553C15.668.013 15.259 0 12 0z" />
                                <path fill="currentColor"
                                    d="M12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a3.999 3.999 0 110-7.998 3.999 3.999 0 010 7.998z" />

                            </svg>
                        </a>
                    @endif
                    @if (!empty($setting->youtube_link))
                        <a href="{{ $setting->youtube_link }}"
                            class="w-10 h-10 bg-gray-800  hover:bg-indigo-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M23.498 6.186a2.997 2.997 0 00-2.108-2.108C19.754 3.667 12 3.667 12 3.667s-7.754 0-9.39.411a2.997 2.997 0 00-2.108 2.108A31.342 31.342 0 000 12a31.342 31.342 0 00.502 5.814 2.997 2.997 0 002.108 2.108C4.246 20.333 12 20.333 12 20.333s7.754 0 9.39-.411a2.997 2.997 0 002.108-2.108A31.342 31.342 0 0024 12a31.342 31.342 0 00-.502-5.814zM9.545 15.568V8.432l6.182 3.568-6.182 3.568z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            @php
                $pages = [
                    'about' => \App\Models\Page::where('slug', 'about-us')->first(),
                    'contact' => \App\Models\Page::where('slug', 'contact-us')->first(),
                    'payment' => \App\Models\Page::where('slug', 'payment-methods')->first(),
                    'moneyback' => \App\Models\Page::where('slug', 'money-back-guarantee')->first(),
                    'returns' => \App\Models\Page::where('slug', 'returns')->first(),
                    'terms' => \App\Models\Page::where('slug', 'terms-and-conditions')->first(),
                    'privacy' => \App\Models\Page::where('slug', 'privacy-policy')->first(),
                ];
            @endphp


            <!-- Useful Links -->
            <div>
                <h4 class="text-sm font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-5 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded-full"></span>
                    Useful Links
                </h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}"
                            class="text-sm hover:text-indigo-400 transition-colors duration-300">Home</a></li>

                    <li>
                        @if ($pages['about'])
                            <a href="{{ route('pages', $pages['about']->slug) }}">About Us</a>
                        @else
                            <span class="text-gray-400 cursor-not-allowed">About Us</span>
                        @endif
                    </li>

                    <li>
                        @if ($pages['contact'])
                            <a href="{{ route('pages', $pages['contact']->slug) }}">Contact Us</a>
                        @else
                            <span class="text-gray-400 cursor-not-allowed">Contact Us</span>
                        @endif
                    </li>

                    
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="text-sm font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-5 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded-full"></span>
                    Customer Service
                </h4>
                <ul class="space-y-3">
                    <li>
                        @if ($pages['payment'])
                            <a href="{{ route('pages', $pages['payment']->slug) }}">Payment Methods</a>
                        @else
                            <span class="text-gray-400 cursor-not-allowed">Payment Methods</span>
                        @endif
                    </li>

                    <li>
                        @if ($pages['moneyback'])
                            <a href="{{ route('pages', $pages['moneyback']->slug) }}">Money-back guarantee</a>
                        @else
                            <span class="text-gray-400 cursor-not-allowed">Money-back guarantee</span>
                        @endif
                    </li>

                    <li>
                        @if ($pages['returns'])
                            <a href="{{ route('pages', $pages['returns']->slug) }}">Returns</a>
                        @else
                            <span class="text-gray-400 cursor-not-allowed">Returns</span>
                        @endif
                    </li>

                    <li>
                        @if ($pages['terms'])
                            <a href="{{ route('pages', $pages['terms']->slug) }}">Terms and Conditions</a>
                        @else
                            <span class="text-gray-400 cursor-not-allowed">Terms and Conditions</span>
                        @endif
                    </li>

                    <li>
                        @if ($pages['privacy'])
                            <a href="{{ route('pages', $pages['privacy']->slug) }}">Privacy Policy</a>
                        @else
                            <span class="text-gray-400 cursor-not-allowed">Privacy Policy</span>
                        @endif
                    </li>
                </ul>
            </div>

            <!-- Company Section -->
            <div>
                <h4 class="text-sm font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-5 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded-full"></span>
                    My Account
                </h4>
                <ul class="space-y-3">
                    @if (Auth::check())
                        <li><a href="{{ route('cart') }}"
                                class="text-sm hover:text-indigo-400 transition-colors duration-300">View
                                Cart</a></li>
                    @else
                        <li><a href="{{ route('login') }}"
                                class="text-sm hover:text-indigo-400 transition-colors duration-300">View
                                Cart</a></li>
                    @endif


                </ul>
            </div>

            <!-- Newsletter Section -->
            <div>
                <h4 class="text-sm font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-5 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded-full"></span>
                    Newsletter
                </h4>
                <p class="text-sm text-gray-400 mb-4">Get exclusive offers and updates delivered to your inbox.</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Enter your email"
                        class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                    <button type="submit"
                        class="w-full px-4 py-2.5 bg-[#0b7a93] text-white text-sm font-semibold rounded-lg transition-all duration-300 transform hover:scale-105">
                        Subscribe
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-3">We respect your privacy. Unsubscribe anytime.</p>
            </div>
        </div>


    </div>

    <!-- Footer Bottom -->
    <div class="bg-black bg-opacity-40">
        <div class="text-center py-6">
            <p>© {{ date('Y') }} @if (!empty($setting->website_name))
                    {{ $setting->website_name }}
                @endif. All Rights Reserved.</p>
        </div>

    </div>
</footer>
