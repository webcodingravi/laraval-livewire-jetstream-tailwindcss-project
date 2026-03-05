<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">System Settings</h2>
            </div>


        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <form wire:submit.prevent="systemSetting" class="flex flex-col gap-8 p-6" enctype="multipart/form-data">
                <div class="flex gap-1 flex-col">
                    <label class="font-medium text-md text-slate-800">Website Name<span
                            class="text-rose-500">*</span></label>
                    <input type="text" wire:model="website_name"
                        class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                        placeholder="Enter Website Name...">
                    @error('website_name')
                        <span class="text-rose-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gird-cols-1 gap-6">
                    <div class="flex gap-1 flex-col md:border-r">
                        <label class="font-medium text-md text-slate-800">Logo</label>
                        <div class="relative w-fit h-25">
                            <i class="ri-upload-cloud-2-line text-6xl text-[#0b7a93]"></i>
                            <input type="file" wire:model="logo" accept="image/*"
                                class="absolute left-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                        @error('logo')
                            <span class="text-rose-500">{{ $message }}</span>
                        @enderror

                        {{-- OLD IMAGE --}}
                        <div class="mt-3">
                            @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" class=" object-cover rounded border">
                            @elseif($oldLogo)
                                <img
                                    src="{{ asset('storage/uploads/settings/' . $oldLogo) }}"class="object-cover rounded border">
                            @endif
                        </div>


                    </div>

                    <div class="flex gap-1 flex-col ">

                        <label class="font-medium text-md text-slate-800">Favicon</label>
                        <div class="relative w-fit h-25">
                            <i class="ri-upload-cloud-2-line text-6xl text-[#0b7a93]"></i>
                            <input type="file" wire:model="favicon" accept="image/*"
                                class="absolute left-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                        @error('favicon')
                            <span class="text-rose-500">{{ $message }}</span>
                        @enderror


                        {{-- OLD Favicon --}}

                        <div class="mt-3">
                            @if ($favicon)
                                <img src="{{ $favicon->temporaryUrl() }}" class="object-cover rounded border">
                            @elseif($oldFavicon)
                                <img
                                    src="{{ asset('storage/uploads/settings/' . $oldFavicon) }}"class="object-cover rounded border">
                            @endif
                        </div>



                    </div>

                </div>

                <div class="flex gap-1 flex-col">
                    <label class="font-medium text-md text-slate-800">Address</label>
                    <textarea rows="3" cols="3" wire:model="address"
                        class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0" placeholder="Enter Address..."></textarea>

                </div>

                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Phone Number</label>
                        <input type="number" wire:model="phone_number"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="0000000000">
                        @error('phone_number')
                            <span class="text-rose-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Email Id</label>
                        <input type="text" wire:model="email"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="example@gmail.com">
                        @error('email')
                            <span class="text-rose-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Facebook Link</label>
                        <input type="text" wire:model="facebook_link"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="https://www.facebook.com/">

                    </div>
                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Twitter Link</label>
                        <input type="text" wire:model="twitter_link"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="https://x.com/">

                    </div>
                </div>


                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Instagram Link</label>
                        <input type="text" wire:model="instagram_link"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="https://www.instagram.com/">

                    </div>
                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Youtube Link</label>
                        <input type="text" wire:model="youtube_link"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="https://www.youtube.com/">

                    </div>
                </div>

                <div class="flex gap-1 flex-col">
                    <label class="font-medium text-md text-slate-800">Footer Description</label>
                    <textarea rows="3" cols="3" wire:model="footer_description"
                        class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0" placeholder="Enter Website Name..."></textarea>

                </div>

                <div class="flex gap-1 flex-col">
                    <button wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                        wire:target="systemSetting"
                        class="px-4 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all w-fit">


                        <span wire:loading.remove wire:target="systemSetting" class="flex gap-1 items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update Setting</span>
                        <!-- Loading spinner/text -->
                        <span wire:loading wire:target="systemSetting">
                            Updating...

                        </span>


                    </button>


                </div>
            </form>


        </div>





    </main>
</div>
