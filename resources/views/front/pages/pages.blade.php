<div>

    <div class="w-11/12 mx-auto py-12 mt-[100px]">

        @if (
            (!empty($page) && $page->slug === 'about-us') ||
                $page->slug === 'payment-methods' ||
                $page->slug === 'money-back-guarantee' ||
                $page->slug === 'returns' ||
                $page->slug === 'terms-and-conditions' ||
                $page->slug === 'privacy-policy')

            <div class="w-full md:h-[500px] h-[200px] bg-slate-300 relative">
                @if (!empty($page->image))
                    <img src="{{ asset('storage/uploads/pages/' . $page->image) }}" class="w-full h-full object-cover">
                @endif

                <div class="absolute insert-0 top-0 left-0 w-full h-full bg-black/50"></div>
                @if (!empty($page->title))
                    <div class="w-full h-full p-4 text-center flex items-center justify-center absolute top-0 left-0">
                        <h1 class="md:text-6xl text-3xl font-bold  text-white">
                            {{ $page->title }}
                        </h1>
                    </div>
                @endif

            </div>

            <div class=" text-lg text-gray-700 leading-relaxed my-8">
                {!! $page->description !!}
            </div>
        @elseif (!empty($page) && $page->slug === 'contact-us')
            <div class="w-full md:h-[500px] h-[200px] bg-slate-300 relative rounded-lg overflow-hidden">
                @if (!empty($page->image))
                    <img src="{{ asset('storage/uploads/pages/' . $page->image) }}" class="w-full h-full object-cover">
                @endif

                <div class="absolute insert-0 top-0 left-0 w-full h-full bg-black/50"></div>
                @if (!empty($page->title))
                    <div class="w-full h-full p-4 text-center flex items-center justify-center absolute top-0 left-0">
                        <h1 class="md:text-6xl text-3xl font-bold  text-white">
                            {{ $page->title }}
                        </h1>
                    </div>
                @endif
            </div>



            <!-- Contact Section -->
            <div class="grid md:grid-cols-2 gap-4 mt-8">
                <!-- Contact Information -->
                <div class="space-y-2">
                    {!! $page->description !!}

                    <!-- Contact Cards -->
                    <div class="space-y-6">

                        @php
                            $setting = \App\Models\SystemSetting::firstOrFail();
                        @endphp

                        <div class="flex items-center gap-4 mt-8">
                            <div class="bg-[#1BA2BF] text-white p-3 rounded-lg">
                                <i class="ri-map-pin-line text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold ">Address</h4>
                                <p class="text-gray-600 text-sm">
                                    {{ $setting->address }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="bg-[#1BA2BF] text-white p-3 rounded-lg">
                                <i class="ri-phone-line text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Phone</h4>
                                <p class="text-gray-600 text-sm">
                                    +91+{{ $setting->phone_number }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="bg-[#1BA2BF] text-white p-3 rounded-lg">
                                <i class="ri-mail-ai-line text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Email</h4>
                                <p class="text-gray-600 text-sm">
                                    {{ $setting->email }}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>


                <!-- Contact Form -->
                <div class="bg-white">
                    @session('success')
                        <div class="mb-6 p-4 bg-green-50 border-2 border-green-200 rounded-lg flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
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

                    <div class="mb-5">
                        <h1 class="text-2xl font-medium"> Got Any Questions?</h1>
                        <span class="text-slate-800">Use the form below to get in touch with the sales team</span>
                    </div>


                    <form class="space-y-5 border rounded-xl p-8" wire:submit.prevent="submitForm">
                        <div>
                            <label class="text-sm font-medium">Name</label>
                            <input type="text" wire:model="name" placeholder="Enter Your Name..."
                                class="w-full mt-2 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1BA2BF]">
                            @error('name')
                                <span class="text-rose-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-medium">Mobile Number</label>
                            <input type="tel" wire:model.live.debounce.500ms="phone"
                                placeholder="Enter Your Mobile Number"
                                class="w-full mt-2 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1BA2BF]">
                            @error('phone')
                                <span class="text-rose-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>


                        <div>
                            <label class="text-sm font-medium">Email</label>
                            <input type="email" wire:model.live.debounce.500ms="email"
                                placeholder="Enter Your Email..."
                                class="w-full mt-2 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1BA2BF]">
                            @error('email')
                                <span class="text-rose-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-medium">Subject</label>
                            <input type="text" wire:model="subject" placeholder="Enter Your Subject..."
                                class="w-full mt-2 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1BA2BF]">
                            @error('subject')
                                <span class="text-rose-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-medium">Message</label>
                            <textarea rows="5" wire:model="message" placeholder="Enter Your Message..."
                                class="w-full mt-2 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1BA2BF]"></textarea>
                            @error('message')
                                <span class="text-rose-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>

                        <button wire:loading.attr="disabled" wire:target="submitForm"
                            class="w-full py-3 px-6  text-white font-bold rounded-lg transition transform
           flex justify-center items-center gap-2
           disabled:bg-gray-400 disabled:cursor-not-allowed bg-[#00A6CC]

            hover:scale-105 active:scale-95"
                            @if (!$name || !$email || !$phone || !$subject || !$message) disabled @endif
                            class="w-full bg-[#1BA2BF] active:scale-95 text-white font-semibold py-3 rounded-lg transition duration-300">
                            <span wire:loading.remove wire:target="submitForm">Send Message</span>
                            <!-- Loading spinner/text -->
                            <span wire:loading wire:target="submitForm" class="flex gap-4">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>

                            </span>

                        </button>



                    </form>

                </div>

            </div>


            {{-- <div class=" text-lg text-gray-700 leading-relaxed my-8">
                <div class="flex flex-col gap-4">
                    <div>
                        {!! $page->description !!}
                    </div>

                    <div>
                        <h1>The Office</h1>
                        <address>
                            Smart Shopping Pvt. Ltd. 2nd Floor, Orion Tech Park Sector 62, Noida Uttar Pradesh – 201309,
                            India
                        </address>
                        <span>011-25326648</span>
                        <span>support@smartshopping.com</span>
                    </div>

                </div>

                <div>

                </div>
            </div> --}}
        @endif




    </div>

    <x-front.benefits-section />

</div>
