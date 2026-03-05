<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">All Customers</h2>
                <p class="text-gray-600 mt-1">Manage your Customers</p>
            </div>


        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow-sm p-4 md:p-6 mb-6">
            <div class="flex md:flex-row flex-col md:justify-end items-center gap-4">
                <div class="flex md:flex-row flex-col gap-6">

                    <div>
                        <button wire:click="export">
                            <i class="ri-file-excel-2-fill text-4xl text-green-600 hover:text-green-800"></i>

                        </button>

                    </div>

                    <div>
                        <button wire:click="$toggle('showTrashed')"
                            class="bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all px-6 py-2">
                            {{ $showTrashed ? 'Show Active' : 'Show Trash' }}
                        </button>
                    </div>



                    <div>
                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search...."
                            class="border border-gray-300 rounded-lg focus:outline-none focus:ring-0">
                    </div>
                </div>

            </div>
        </div>

        <!-- Categories Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">S.No</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Fullname</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Email</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Phone Number</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Full Address</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">City</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">State</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Country</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Pincode</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Created Date</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($customers->isNotEmpty())
                            @foreach ($customers as $customer)
                                <tr class=" border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}
                                        </p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $customer->fullname }}
                                        </p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $customer->email }}</p>


                                    </td>


                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            +91-{{ $customer->phone_number }}
                                        </p>


                                    </td>


                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $customer->address->address }}</p>


                                    </td>


                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $customer->address->city }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $customer->address->state }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $customer->address->country }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $customer->address->zip_code }}</p>


                                    </td>


                                    <td class="py-4 px-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($customer->created_at)->format('d M Y') }}

                                    </td>


                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">

                                            @if (!$showTrashed)
                                                <button wire:click="delete({{ $customer->id }})"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            @else
                                                <button wire:click="restore({{ $customer->id }})"
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                                    <i class="ri-reset-right-fill text-xl"></i>
                                                </button>

                                                <button wire:click="forceDelete({{ $customer->id }})"
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
                                <td colspan="11" class="text-center p-4">Empty Customers</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $customers->links() }}
            </div>
        </div>




    </main>
</div>
