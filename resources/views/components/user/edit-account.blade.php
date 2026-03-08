<div>

    @php
        $states = [
            'Andhra Pradesh',
            'Arunachal Pradesh',
            'Assam',
            'Bihar',
            'Chhattisgarh',
            'Goa',
            'Gujarat',
            'Haryana',
            'Himachal Pradesh',
            'Jharkhand',
            'Karnataka',
            'Kerala',
            'Madhya Pradesh',
            'Maharashtra',
            'Manipur',
            'Meghalaya',
            'Mizoram',
            'Nagaland',
            'Odisha',
            'Punjab',
            'Rajasthan',
            'Sikkim',
            'Tamil Nadu',
            'Telangana',
            'Tripura',
            'Uttar Pradesh',
            'Uttarakhand',
            'West Bengal',

            // Union Territories
            'Andaman and Nicobar Islands',
            'Chandigarh',
            'Dadra and Nagar Haveli and Daman and Diu',
            'Delhi',
            'Jammu and Kashmir',
            'Ladakh',
            'Lakshadweep',
            'Puducherry',
        ];
    @endphp

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
                <p class="text-slate-900 font-medium">+91-{{ Auth::user()->phone_number ?? 'Not set' }}
                </p>
            </div>
            <div class="pt-2 border-t border-slate-200">
                <button wire:click="openModal" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Edit
                    Profile</button>
            </div>
        </div>
    </div>


    {{-- open modal --}}
    @if ($isOpen)
        <div
            class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn z-[9999]">
            <div
                class="bg-white rounded md:w-6/12 w-full p-4 shadow-md animate__animated animate__zoomIn overflow-y-auto max-h-screen">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-semibold">Account Settings
                    </h1>
                    <button class="text-xl cursor-pointer" wire:click="closeModal">X</button>

                </div>
                <hr class="text-slate-200 my-4">

                <!-- Main Content -->

                <section class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex items-center space-x-6">
                                <div class="relative">
                                    <img src="{{ $profile_photo ? $profile_photo->temporaryUrl() : ($currentProfilePhoto ? asset('storage/' . $currentProfilePhoto) : asset('https://www.twtf.org.uk/wp-content/uploads/2024/01/dummy-image.jpg')) }}"
                                        alt="Profile" class="w-24 h-24 rounded-full border-4 border-blue-100">


                                   <div
                                class="absolute bottom-0 right-0 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] text-white p-2 rounded-full transition shadow-lg">
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
                        </div>

                        <div class="p-6 space-y-6">

                            <!-- Form Fields -->
                            <form class="space-y-6" wire:submit.prevent="saveChanges">
                                <div class="flex flex-col gap-6">
                                    <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">First
                                                Name</label>
                                            <input type="text" wire:model="first_name"
                                                placeholder="Enter First Name.."
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent outline-none transition">

                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Last
                                                Name</label>
                                            <input type="text" wire:model="last_name" placeholder="Enter Last Name.."
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent outline-none transition">

                                        </div>
                                    </div>

                                    <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Email</label>
                                            <input type="text" wire:model="email" placeholder="Enter Email.."
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent outline-none transition">

                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Phone</label>
                                            <input type="number" wire:model="phone_number"
                                                placeholder="Enter Phone Number.."
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent outline-none transition">

                                        </div>
                                    </div>


                                    <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">City </label>
                                            <input type="text" wire:model="city" placeholder="City Name.."
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent  ">

                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                State</label>
                                            <select wire:model="state"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent cursor-pointer">
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state }}">{{ $state }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>


                                    <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code
                                            </label>
                                            <input type="number" wire:model="zip_code" placeholder="Zip Code"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent "
                                                placeholder="10001">

                                        </div>

                                        <!-- Country -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Country </label>
                                            <select wire:model="country"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent ">
                                                <option value="india">India</option>
                                            </select>

                                        </div>
                                    </div>



                                    <!-- Shipping Address -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Shipping
                                            Address</label>
                                        <textarea wire:model="shipping_address" rows="4" placeholder="Shipping Address..."
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent outline-none transition resize-none"></textarea>

                                    </div>

                                    <!-- Billing Address -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Billing
                                            Address</label>
                                        <textarea rows="4" wire:model="billing_address" placeholder="Billing Address..."
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0b7a93] focus:border-transparent outline-none transition resize-none"></textarea>


                                    </div>


                                    <!-- Save Button -->
                                    <div class="pt-4 flex justify-end gap-3">
                                        <button type="submit"
                                            class="px-6 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all font-medium flex items-center">
                                            <i class="ri-save-line mr-2"></i>
                                            Save Changes
                                        </button>
                                    </div>

                            </form>
                        </div>
                </section>
            </div>
        </div>
    @endif


</div>
