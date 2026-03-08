<div>
    <button class="flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700" wire:click="openModal">
        <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
            </path>
        </svg>
        <span class="text-sm font-medium">My Addresses</span>
    </button>


    {{-- open modal --}}
    @if ($isOpen)
        <div
            class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn z-[9999]">
            <div
                class="bg-white rounded md:w-6/12 w-full p-4 shadow-md animate__animated animate__zoomIn overflow-y-auto max-h-screen">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-semibold">My Address
                    </h1>
                    <button class="text-xl cursor-pointer" wire:click="closeModal">X</button>

                </div>
                <hr class="text-slate-200 my-4">

                <!-- Main Content -->

                <div class="flex flex-col gap-8">
                   
                    <div class="flex flex-col gap-1">
                        <label class="text-slate-800">Shipping Address</label>
                        <textarea wire:model="shipping" class="border border-slate-200 rounded" readonly cols="4" rows="4"></textarea>

                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-slate-800">Billing Address</label>
                        <textarea wire:model="billing" class="border border-slate-200 rounded" readonly cols="4" rows="4"></textarea>

                    </div>
                </div>


            </div>
        </div>
    @endif

</div>
