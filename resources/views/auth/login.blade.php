<div>
    <div class="absolute top-9 left-12">
        <a href="{{ route('home') }}" class="block hover:scale-95 transition-all duration-300" wire:navigate>
            <i class="ri-arrow-left-line font-medium text-[#0684a3] text-md"></i>
            <span class="font-medium text-[#0684a3] text-md">Back</span>
        </a>
    </div>

    <div class="flex justify-center items-center h-screen">
        <div class="bg-white rounded-2xl p-8 md:p-10 lg:w-4/12 w-full shadow-md">
            <!-- Form Header -->
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back !</h2>
                <p class="text-gray-600">Access your ShopHub account</p>
            </div>


            <!-- Session Status -->
            @session('success')
                <div class="mb-6 p-4 bg-green-50 border-2 border-green-200 rounded-lg flex items-start gap-3">
                    <svg class="w-6 h-6 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-green-700 font-medium">{{ $value }}</p>
                </div>
            @endsession

            @session('error')
                <div class="mb-6 p-4 bg-rose-50 border-2 border-rose-200 rounded-lg flex items-start gap-3">
                    <svg class="w-6 h-6 text-rose-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-rose-700 font-medium">{{ $value }}</p>
                </div>
            @endsession

            <!-- Login Form -->
            <form wire:submit.prevent="login" class="space-y-6 w-full">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Email
                        Address</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <input type="text" wire:model.live.debounce.500ms="email" placeholder="john@example.com"
                            autofocus autocomplete="username"
                            class="w-full pl-12 pr-4 py-3 border-2 {{ $errors->has('email') ? 'border-rose-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-[#00A6CC] transition bg-gray-50 focus:bg-white">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-rose-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-gray-900">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-[#00A6CC] font-semibold transition">
                                Forgot?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <input type="password" wire:model.live.debounce.500ms="password" placeholder="••••••••"
                            id="password"
                            class="w-full pl-12 {{ $errors->has('password') ? 'border-rose-500' : 'border-gray-200' }} pr-12 py-3 border-2  rounded-lg focus:outline-none focus:border-[#00A6CC] transition bg-gray-50 focus:bg-white">
                        <button type="button" onclick="togglePasswordVisibility('password')"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-5 h-5 toggle-eye-icon" id="password-eye-icon" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-rose-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" wie:model="remember"
                        class="w-5 h-5 text-[#00A6CC] rounded border-gray-300 focus:outline-none focus:ring-0 cursor-pointer">
                    <label for="remember_me" class="ms-3 text-sm text-gray-700 cursor-pointer">
                        Remember me
                    </label>
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="login"
                    class="w-full py-3 px-6  text-white font-bold rounded-lg transition transform
           flex justify-center items-center gap-2
           disabled:bg-gray-400 disabled:cursor-not-allowed bg-[#00A6CC]

           hover:scale-105 active:scale-95"
                    @if (!$email || !$password) disabled @endif>
                    <!-- Normal text -->
                    <span wire:loading.remove wire:target="login">Sign In</span>

                    <!-- Loading spinner/text -->
                    <span wire:loading wire:target="login" class="flex gap-4">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>

                    </span>
                </button>

            </form>


            <div class="flex gap-1 justify-center items-center my-6">
                <hr class="w-full" />
                <span>OR</span>
                <hr class=" w-full" />
            </div>

            <div class="my-6">
                <a href="{{ route('google.redirect') }}"
                    class="w-full flex items-center justify-center px-6 py-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium bg-white hover:bg-gray-50">
                    <img class="h-5 w-5 mr-3" src="{{ asset('assets/img/google.png') }}" alt="Google icon">
                    Sign In with Google
                </a>
            </div>


            <!-- Sign Up Link -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-[#00A6CC] hover:text-indigo-700 font-semibold"
                        wire:navigate>Create one</a>
                </p>
            </div>





        </div>
    </div>
</div>


@push('script')
    <script>
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye-icon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.856a3.375 3.375 0 11-4.753-4.753m7.538 1.894a3 3 0 00-4.242-4.242m5.503 6.897a3.375 3.375 0 01-4.753-4.753M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>';
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
@endpush
