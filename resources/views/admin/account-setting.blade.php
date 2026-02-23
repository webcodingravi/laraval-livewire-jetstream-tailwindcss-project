<div class="p-4 sm:p-6 lg:p-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Account Settings</h1>
        <p class="text-gray-600 mt-2">Manage your account information and preferences</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            <!-- Profile Section -->
            <section id="profile" class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <i class="ri-user-line text-2xl text-blue-500 mr-3"></i>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Profile Information</h2>
                            <p class="text-sm text-gray-600">Update your personal details</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Profile Avatar -->

                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <img src="{{ $profile_photo ? $profile_photo->temporaryUrl() : ($currentProfilePhoto ? asset('storage/' . $currentProfilePhoto) : asset('https://www.twtf.org.uk/wp-content/uploads/2024/01/dummy-image.jpg')) }}"
                                alt="Profile" class="w-24 h-24 rounded-full border-4 border-blue-100">


                            <div
                                class="absolute bottom-0 right-0 bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition shadow-lg">
                                <input type="file" wire:model="profile_photo"
                                    class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                                <span>
                                    <i class="ri-camera-line cursor-pointer"></i>
                                </span>
                            </div>

                        </div>
                        <div>
                            <p class="text-gray-900 font-medium">{{ $first_name }} {{ $last_name }}</p>
                            <p class="text-gray-600 text-sm">{{ $email }}</p>
                            <div wire:loading wire:target="profile_photo" class="text-sm text-gray-500">
                                Uploading...
                            </div>


                        </div>
                    </div>

                    <!-- Form Fields -->
                    <form wire:submit.prevent="updateProfile" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" wire:model="first_name" placeholder="Enter First Name.."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                                @error('first_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" wire:model="last_name" placeholder="Enter Last Name.."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                                @error('last_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="text" wire:model.live="email" placeholder="Enter Email Id.."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
                                <div class="flex gap-1 items-center">
                                    <!-- Country Code Select with Flag -->
                                    <div class="relative">
                                        <select id="country_code" wire:model="phone_code"
                                            class="appearance-none px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-white cursor-pointer hover:border-gray-400"
                                            style="min-width: 40px;">
                                            <option value="+1">+1</option>
                                            <option value="+44">+44</option>
                                            <option value="+91">+91</option>
                                            <option value="+92">+92</option>
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
                                            <option value="+65">+65</option>
                                            <option value="+60">+60</option>
                                        </select>
                                        <i
                                            class="ri-arrow-down-s-line absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                                    </div>
                                    <!-- Phone Number Input -->
                                    <div class="flex-1 relative">
                                        <input type="tel" wire:model="phone_number" name="phone_number"
                                            placeholder="10-digit number"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                            maxlength="15">

                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Select country and enter phone number without
                                    country
                                    code</p>
                            </div>


                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" placeholder="Enter new password"
                                    wire:model.live.debounce.500ms="password"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                                <p class="text-xs text-gray-600 mt-2">Minimum 8 characters, include uppercase,
                                    lowercase, special character,
                                    and
                                    numbers</p>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Bio -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                <textarea rows="4" wire:model="bio" placeholder="Tell us about yourself..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"></textarea>
                                @error('bio')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                <input type="password" placeholder="Confirm new password"
                                    wire:model.live.lazy.500ms="password_confirmation"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                                @error('password_confirmation')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <!-- Save Button -->
                        <div class="pt-4 border-t border-gray-200 flex justify-end gap-3">
                            <button type="submit" wire:loading.attr="disabled" wire:target="updateProfile"
                                wire:loading.class="cursor-not-allowed opacity-50"
                                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-medium flex items-center">
                                <i class="ri-save-line mr-2"></i>
                                Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </section>



        </div>
    </div>
</div>
