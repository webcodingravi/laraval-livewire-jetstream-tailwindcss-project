<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">SMTP Settings</h2>
            </div>


        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <form wire:submit.prevent="smtpSetting" class="flex flex-col gap-8 p-6">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
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

                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Mail Mailer</label>
                        <input type="text" wire:model="mail_mailer"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Mail Mailer">

                    </div>
                </div>



                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">

                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Mail Host</label>
                        <input type="text" wire:model="mail_host"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Mail Host">

                    </div>

                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Mail Port</label>
                        <input type="number" wire:model="mail_port"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Mail Port">
                        @error('mail_port')
                            <span class="text-rose-500">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">

                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Mail Username</label>
                        <input type="text" wire:model="mail_username"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Mail Username">

                    </div>

                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Mail Encryption</label>
                        <input type="text" wire:model="mail_encryption"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Mail Encryption">

                    </div>
                </div>

                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Mail Password</label>
                        <input type="text" wire:model="mail_password"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Mail Port">
                    </div>

                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Mail From Adress</label>
                        <input type="text" wire:model="mail_from_address"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Mail From Address">

                    </div>


                </div>

                <div class="flex gap-1 flex-col">
                    <button wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                        wire:target="smtpSetting"
                        class="px-4 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all w-fit">


                        <span wire:loading.remove wire:target="smtpSetting" class="flex gap-1 items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update SMTP</span>
                        <!-- Loading spinner/text -->
                        <span wire:loading wire:target="smtpSetting">
                            Updating...

                        </span>


                    </button>


                </div>


            </form>


        </div>


    </main>
</div>
