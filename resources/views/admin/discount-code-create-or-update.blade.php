<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Discount Code</h2>
                <p class="text-gray-600 mt-1">Manage your Discount Code</p>
            </div>

            <button wire:click="openModal"
                class="w-full sm:w-auto px-6 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all flex items-center justify-center gap-2 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Discount Code
            </button>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow-sm p-4 md:p-6 mb-6">
            <div class="flex md:flex-row flex-col md:justify-end items-center gap-4">


                <div>
                    <button wire:click="$toggle('showTrashed')"
                        class="bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all px-6 py-2">
                        {{ $showTrashed ? 'Show Active' : 'Show Trash' }}
                    </button>
                </div>

                <div>
                    <select wire:model.live.debounce.500ms="filterStatus"
                        class="border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All</option>
                        <option value="active">Active</option>
                        <option value="deactive">Deactive</option>
                    </select>
                </div>

                <div>
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search Discount Code..."
                        class="border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

            </div>
        </div>

        <!-- Categories Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">S.No.</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Discount Code</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Type</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">
                                Amount({{ config('app.currency.symbol') }}) / Percent (%)</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Expiry Date</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($discountCodes->isNotEmpty())
                            @foreach ($discountCodes as $discountCode)
                                <tr class=" border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ ($discountCodes->currentPage() - 1) * $discountCodes->perPage() + $loop->iteration }}
                                        </p>

                                    </td>

                                    <td>
                                        <p class="font-semibold text-gray-900">
                                            {{ $discountCode->name }}</p>
                                    </td>

                                    <td>
                                        <p class="font-semibold text-gray-900">
                                            {{ ucfirst($discountCode->type) }}</p>
                                    </td>



                                    <td class="py-4 px-4">

                                        <p class="font-semibold text-gray-900">
                                            @if ($discountCode->type === 'amount')
                                                {{ config('app.currency.symbol') }}{{ number_format($discountCode->percent_amount, 2) }}
                                            @else
                                                {{ round($discountCode->percent_amount) }}%
                                            @endif
                                        </p>


                                    </td>


                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($discountCode->expiry_date)->format('d-m-Y') }}
                                        </p>


                                    </td>



                                    <td class="py-4 px-4">
                                        @if ($discountCode->status === 'active')
                                            <span
                                                class='px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold'>Active</span>
                                        @else
                                            <span
                                                class='px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold'>Deactive</span>
                                        @endif


                                    </td>

                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <button wire:click="edit({{ $discountCode->id }})"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            @if (!$showTrashed)
                                                <button wire:click="delete({{ $discountCode->id }})"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            @else
                                                <button wire:click="restore({{ $discountCode->id }})"
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                                    <i class="ri-reset-right-fill text-xl"></i>
                                                </button>

                                                <button wire:click="forceDelete({{ $discountCode->id }})"
                                                    class="p-2 text-rose-600 hover:bg-indigo-50 rounded-lg transition">
                                                    <i class="ri-delete-bin-2-line text-xl"></i>
                                                    force delete
                                                </button>
                                            @endif


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center p-4">Empty Discount Code</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $discountCodes->links() }}
            </div>
        </div>



        {{-- open modal --}}
        @if ($isOpen)
            <div class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn">
                <div
                    class="bg-white rounded md:w-6/12 w-full p-4 shadow-md animate__animated animate__zoomIn overflow-y-auto max-h-screen">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold">
                            {{ $isEdit ? 'Edit Discount Code' : 'Add New Discount Code' }}</h1>
                        <button class="text-xl cursor-pointer" wire:click="closeModal">X</button>

                    </div>
                    <hr class="text-slate-200 my-4">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="flex flex-col gap-8">
                        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 w-full">
                            <div class="flex gap-1 flex-col">
                                <label class="font-medium text-md text-slate-800">Discount Code<span
                                        class="text-rose-500">*</span></label>
                                <input type="text" wire:model="name"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                    placeholder="Enter Discount...">
                                @error('name')
                                    <span class="text-rose-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex gap-1 flex-col">
                                <label class="font-medium text-md text-slate-800">Type<span
                                        class="text-rose-500">*</span></label>
                                <select wire:model="type"
                                    class="border  border-slate-200 p-4 rounded focus:outline-none cursor-pointer">
                                    <option value="amount">Amount</option>
                                    <option value="percent">Percent</option>
                                </select>
                            </div>
                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex gap-1 flex-col">
                                <label
                                    class="font-medium text-md text-slate-800">Amount({{ config('app.currency.symbol') }})
                                    / Percent(%)<span class="text-rose-500">*</span></label>
                                <input type="number" step="0.01" wire:model="percent_amount"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none"
                                    placeholder="0.0">
                                @error('percent_amount')
                                    <span class="text-rose-500">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="flex gap-1 flex-col">
                                <label class="font-medium text-md text-slate-800">Expiry
                                    Date
                                    <span class="text-rose-500">*</span></label>
                                <input type="date" wire:model="expiry_date" min="{{ now()->format('Y-m-d') }}"
                                    class="border rounded-md border-slate-200 p-4 focus:outline-none">
                                @error('expiry_date')
                                    <span class="text-rose-500">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="flex gap-1 flex-col w-fit">
                            <label class="font-medium text-md text-slate-800">Status<span
                                    class="text-rose-500">*</span></label>
                            <select wire:model="status"
                                class="border rounded  border-slate-200 px-4 py-3 focus:outline-none cursor-pointer">
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>

                        </div>

                        <div class="flex gap-1 flex-col">

                            <button wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                                wire:target={{ $isEdit ? 'update' : 'save' }}
                                class="px-4 py-2 bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all w-fit flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $isEdit ? 'Update Discount' : 'Add Discount' }}</button>


                        </div>
                    </form>

                </div>
            </div>
        @endif

    </main>
</div>
