<x-guest-layout>
    <livewire:components.front.header />

    <!-- Premium Registration Page -->
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50" x-data="{ passwordStrength: 0, showPassword: false }">
        <div class="flex justify-center items-center md:h-screen md:w-5/12 mx-auto md:mt-8 mt-[160px]">
            <!-- Right Side - Registration Form -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10 w-full mt-[50px]">
                <!-- Form Header -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                    <p class="text-gray-600">Join ShopHub and start your shopping journey</p>
                </div>

                <!-- Registration Form -->
                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Full Name Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Please Enter Your Name..."
                                class="w-full pl-12 pr-4 py-3 border-2 {{ $errors->has('name') ? 'border-rose-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-indigo-600 transition bg-gray-50 focus:bg-white">
                        </div>
                        @error('name')
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

                    <!-- Email Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="Enter Email Id..."
                                class="w-full pl-12 pr-4 py-3 border-2 {{ $errors->has('email') ? 'border-rose-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-indigo-600 transition bg-gray-50 focus:bg-white">
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

                    <!-- Phone Number Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Phone Number</label>
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                            <!-- Phone Code Selector -->
                            <div class="md:col-span-2">
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948.684l1.498 4.493a1 1 0 00.502.756l2.048 1.029a2 2 0 002.992-2.353A9.986 9.986 0 0015 6m0 0h3.28a2 2 0 012 2v3.28a2 2 0 01-.684 1.948l-4.493 1.498a1 1 0 00-.756.502l-1.029 2.048a2 2 0 01-2.353 2.992A9.986 9.986 0 0315 9m0 0H6">
                                            </path>
                                        </svg>
                                    </div>
                                    <select name="phone_code"
                                        class="w-full pl-12 pr-4 py-3 border-2 {{ $errors->has('phone_code') ? 'border-rose-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-indigo-600 transition bg-gray-50 focus:bg-white appearance-none cursor-pointer font-medium text-gray-900"
                                        style="background-image: url('data:image/svg+xml;utf8,<svg fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" xmlns=\"http://www.w3.org/2000/svg\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 14l-7 7m0 0l-7-7m7 7V3\"></path></svg>'); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1.5rem; padding-right: 2.5rem;">
                                        <option value="+91">+91</option>
                                        <option value="+1">+1</option>
                                        <option value="+44">+44</option>
                                        <option value="+86">+86</option>
                                        <option value="+81">+81</option>
                                        <option value="+33">+33</option>
                                        <option value="+49">+49</option>
                                        <option value="+39">+39</option>
                                        <option value="+34">+34</option>
                                        <option value="+61">+61</option>
                                        <option value="+1">+1</option>
                                        <option value="+55">+55</option>
                                        <option value="+27">+27</option>
                                        <option value="+966">+966</option>
                                        <option value="+971">+971</option>
                                    </select>
                                </div>
                                @error('phone_code')
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

                            <!-- Phone Number Input -->
                            <div class="md:col-span-3">
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 20h8a2 2 0 002-2V4a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                                        placeholder="9876543210"
                                        class="w-full pl-12 pr-4 py-3 border-2 {{ $errors->has('phone_number') ? 'border-rose-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-indigo-600 transition bg-gray-50 focus:bg-white">
                                </div>
                                @error('phone_number')
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
                        </div>
                    </div>

                    <!-- Password Input with Strength Indicator -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="••••••••"
                                @input="passwordStrength = $el.value.length >= 8 && /[A-Z]/.test($el.value) && /[0-9]/.test($el.value) ? 100 : $el.value.length >= 8 ? 50 : 0"
                                class="w-full pl-12 pr-12 py-3 border-2 {{ $errors->has('password') ? 'border-rose-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-indigo-600 transition bg-gray-50 focus:bg-white">
                            <button @click="showPassword = !showPassword" type="button"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                    </path>
                                </svg>
                            </button>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="mt-2 space-y-2">
                            <div class="flex gap-1">
                                <div :class="passwordStrength >= 33 ? 'bg-rose-500' : 'bg-gray-200'"
                                    class="h-1 flex-1 rounded-full transition"></div>
                                <div :class="passwordStrength >= 66 ? 'bg-yellow-500' : 'bg-gray-200'"
                                    class="h-1 flex-1 rounded-full transition"></div>
                                <div :class="passwordStrength >= 100 ? 'bg-green-500' : 'bg-gray-200'"
                                    class="h-1 flex-1 rounded-full transition"></div>
                            </div>
                            <p class="text-xs text-gray-600">
                                <span x-show="passwordStrength === 0">Password must be at least 8 characters</span>
                                <span x-show="passwordStrength === 50" class="text-yellow-600">Medium strength -
                                    add numbers and uppercase</span>
                                <span x-show="passwordStrength === 100" class="text-green-600">Strong password
                                    ✓</span>
                            </p>
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

                    <!-- Confirm Password Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <input type="password" name="password_confirmation" placeholder="••••••••"
                                class="w-full pl-12 pr-4 py-3 border-2 {{ $errors->has('password_confirmation') ? 'border-rose-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-indigo-600 transition bg-gray-50 focus:bg-white">
                        </div>
                        @error('password_confirmation')
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

                    <!-- Terms & Conditions -->
                    <div class="flex items-start gap-3 p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                        <input type="checkbox" id="terms"
                            class="w-5 h-5 mt-1 text-indigo-600 rounded cursor-pointer" required>
                        <label for="terms" class="text-sm text-gray-700 cursor-pointer">
                            I agree to the <a href="#"
                                class="text-indigo-600 hover:text-indigo-700 font-semibold">Terms of Service</a>
                            and <a href="#" class="text-indigo-600 hover:text-indigo-700 font-semibold">Privacy
                                Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105 active:scale-95">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <div class="text-center pt-4 border-t border-gray-200">
                        <p class="text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}"
                                class="text-indigo-600 hover:text-indigo-700 font-semibold">Sign In</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-front.footer />
</x-guest-layout>
