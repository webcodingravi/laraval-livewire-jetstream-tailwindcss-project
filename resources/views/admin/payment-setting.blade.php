<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Payment Settings</h2>
            </div>

        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <form wire:submit.prevent="paymentSetting" class="flex flex-col gap-8 p-6">
                <div class="flex flex-row gap-4 items-center">
                    <label class="font-medium text-md text-slate-800">Cash on Delivery (ON / OFF)</label>
                    <input type="checkbox" wire:model="cod"
                        class="border rounded border-slate-200 p-2 focus:outline-none focus:ring-0">

                </div>
                <hr />

                <div class="flex flex-row gap-4 items-center">
                    <label class="font-medium text-md text-slate-800">Stripe (ON / OFF)</label>
                    <input type="checkbox" wire:model="stripe"
                        class="border rounded border-slate-200 p-2 focus:outline-none focus:ring-0">

                </div>

                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Stripe Public Key</label>
                        <input type="text" wire:model="stripe_public_key"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Stripe Public Key">

                    </div>

                    <div class="flex gap-1 flex-col">
                        <label class="font-medium text-md text-slate-800">Stripe Secret Key</label>
                        <input type="text" wire:model="stripe_secret_key"
                            class="border rounded-md border-slate-200 p-4 focus:outline-none focus:ring-0"
                            placeholder="Enter Stripe Secret Key">


                    </div>
                </div>


                <div class="flex gap-1 flex-col">
                    <button wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                        wire:target="paymentSetting"
                        class="px-4 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all w-fit">


                        <span wire:loading.remove wire:target="paymentSetting" class="flex gap-1 items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update SMTP</span>
                        <!-- Loading spinner/text -->
                        <span wire:loading wire:target="paymentSetting">
                            Updating...

                        </span>


                    </button>


                </div>


            </form>


        </div>


    </main>
</div>
