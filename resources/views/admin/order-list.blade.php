<div>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">All Orders</h2>
                <p class="text-gray-600 mt-1">Manage your All Orders</p>
            </div>


        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow-sm p-4 md:p-6 mb-6">
            <div class="flex md:flex-row flex-col md:justify-between items-center gap-4">

                <div class="flex md:flex-row flex-col gap-7 items-center">
                    <div class="flex md:flex-row flex-col items-center gap-2">
                        <label for="">From Date:</label>
                        <input type="date" wire:model.live.debounce.500ms="fromDate"
                            class="border border-slate-300 rounded cursor-pointer focus:outline-0 focus:ring-0">
                    </div>
                    <div class="flex md:flex-row flex-col gap-2 items-center">
                        <label for="">To Date:</label>
                        <input type="date" wire:model.live.debounce.500ms="toDate"
                            class="border border-slate-300 rounded cursor-pointer focus:outline-0 focus:ring-0">
                    </div>
                    <button wire:click="resetDateFilter"
                        class="bg-gradient-to-br from-[#24bad8] to-[#0b7a93] rounded active:scale-95 duration-300 text-white transition-all px-6 py-2">Reset</button>
                </div>

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
                        <select wire:model.live.debounce.500ms="filterStatus"
                            class="border border-gray-300 rounded-lg focus:outline-none focus:ring-0 cursor-pointer">
                            <option value="">All</option>
                            <option value="pending">Pending</option>
                            <option value="inprogress">In-Progress</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>


                    <div>
                        <input type="text" wire:model.live.debounce.500ms="search"
                            placeholder="Search By Order Number..."
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
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Order Number(#)</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Name</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Email</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Phone Number</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">City</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">State</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Country</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Pincode</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Order Date</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->isNotEmpty())
                            @foreach ($orders as $ord)
                                <tr class=" border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $ord->order_number }}
                                        </p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $ord->shipping_first_name . ' ' . $ord->shipping_last_name }}</p>

                                    </td>


                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $ord->shipping_phone }}
                                        </p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $ord->shipping_email }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $ord->shipping_city }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $ord->shipping_state }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $ord->shipping_country }}</p>


                                    </td>


                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $ord->shipping_zip }}</p>


                                    </td>



                                    <td class="py-4 px-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($ord->created_at)->format('d M Y') }}

                                    </td>


                                    <td class="py-4 px-4">
                                        <select wire:model.live.debounce.500ms="orderStatus.{{ $ord->id }}"
                                            class="border border-gray-300 rounded-lg focus:outline-none focus:ring-0 cursor-pointer">
                                            <option value="pending">Pending</option>
                                            <option value="inprogress">In Progress
                                            </option>
                                            <option value="delivered">Delivered
                                            </option>
                                            <option value="completed">Completed
                                            </option>
                                            <option value="cancelled">Cancelled
                                            </option>
                                        </select>

                                    </td>

                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">
                                            <button wire:click="view({{ $ord->id }})"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            @if (!$showTrashed)
                                                <button wire:click="delete({{ $ord->id }})"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            @else
                                                <button wire:click="restore({{ $ord->id }})"
                                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                                    <i class="ri-reset-right-fill text-xl"></i>
                                                </button>

                                                <button wire:click="forceDelete({{ $ord->id }})"
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
                                <td colspan="12" class="text-center p-4">Empty Orders</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $orders->links() }}
            </div>
        </div>



        {{-- open modal --}}
        @if ($isOpen)
            <div class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn">
                <div
                    class="bg-white rounded md:w-6/12 w-full p-4 shadow-md animate__animated animate__zoomIn overflow-y-auto max-h-screen">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold">View Order
                        </h1>
                        <button class="text-xl cursor-pointer" wire:click="closeModal">X</button>

                    </div>
                    <hr class="text-slate-200 my-4">

                    <div class="text-slate-800 font-medium text-md my-4">
                        <h1>Order Details</h1>
                    </div>
                    <div class="border border-slate-200 flex flex-col">
                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Order Number(#) :</h2>
                            </div>

                            <div>
                                #{{ $order->order_number }}
                            </div>
                        </div>

                        @if (!empty($order->transaction_id))
                            <div class="flex border-b border-b-slate-200 p-4 gap-3">
                                <div>
                                    <h2 class="font-medium text-md">Transaction Id :</h2>
                                </div>

                                <div>
                                    {{ $order->transaction_id }}
                                </div>
                            </div>
                        @endif

                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Name :</h2>
                            </div>

                            <div>
                                {{ $order->shipping_first_name . ' ' . $order->shipping_last_name }}
                            </div>
                        </div>

                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Mobile :</h2>
                            </div>

                            <div>
                                +91-{{ $order->shipping_phone }}
                            </div>
                        </div>

                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Email :</h2>
                            </div>

                            <div>
                                {{ $order->shipping_email }}
                            </div>
                        </div>


                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">City :</h2>
                            </div>

                            <div>
                                {{ $order->shipping_city }}
                            </div>
                        </div>

                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">State :</h2>
                            </div>

                            <div>
                                {{ $order->shipping_state }}
                            </div>
                        </div>


                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Country :</h2>
                            </div>

                            <div>
                                {{ $order->shipping_country }}
                            </div>
                        </div>

                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Pincode :</h2>
                            </div>

                            <div>
                                {{ $order->shipping_zip }}
                            </div>
                        </div>

                        @if (!empty($order->discount_code))
                            <div class="flex border-b border-b-slate-200 p-4 gap-3">
                                <div>
                                    <h2 class="font-medium text-md">Discount Code :</h2>
                                </div>

                                <div>
                                    {{ $order->discount_code }}
                                </div>
                            </div>
                        @endif


                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Shipping Amount({{ config('app.currency.symbol') }}) :
                                </h2>
                            </div>

                            <div>
                                {{ config('app.currency.symbol') . number_format($order->shipping_amount, 2) ?? '0.00' }}
                            </div>
                        </div>


                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Total Amount({{ config('app.currency.symbol') }}) :
                                </h2>
                            </div>

                            <div>
                                {{ config('app.currency.symbol') . number_format($order->total, 2) }}
                            </div>
                        </div>

                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Payment Status
                                </h2>
                            </div>

                            <div>
                                @if ($order->is_payment)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Payment method
                                </h2>
                            </div>

                            <div>
                                {{ ucfirst($order->payment_method) }}
                            </div>
                        </div>


                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Status
                                </h2>
                            </div>

                            <div>
                                <td class="py-4 px-4">
                                    @if ($order->status === 'pending')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Pending
                                        </span>
                                    @elseif($order->status === 'inprogress')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            In-Progress
                                        </span>
                                    @elseif($order->status === 'delivered')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Delivered
                                        </span>
                                    @elseif($order->status === 'cancelled')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                            Cancelled
                                        </span>
                                    @endif
                                </td>
                            </div>
                        </div>


                        <div class="flex p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Order Date
                                </h2>
                            </div>

                            <div>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                            </div>
                        </div>


                    </div>



                    @if (!empty($orderItems))
                        <div class="overflow-x-auto mt-4">
                            <div class="text-slate-800 font-medium text-md my-4">
                                <h1>Order Items</h1>
                            </div>
                            <table class="w-full text-sm border border-slate-200">
                                <thead>
                                    <tr class="border border-slate-200">
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Order Product</th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Total Price</th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orderItems as $item)
                                        @php
                                            $image = $item?->product->productImages->first()?->image_name ?? '';
                                        @endphp
                                        <tr class="border-b border-slate-100 hover:bg-slate-50"
                                            wire:key="order-{{ $item->id }}">


                                            <td class="py-4 px-4 text-slate-900 font-medium">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-20 h-20 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                        <img src="{{ asset('storage/uploads/product/' . $image) }}"
                                                            class="object-cover w-full h-full rounded-lg"
                                                            alt="{{ $item?->product_name ?? '' }}">
                                                    </div>

                                                    <div>

                                                        <p class="font-semibold text-gray-900">
                                                            {{ $item->product_name ?? 'No product' }}
                                                        </p>

                                                        <p class="text-sm text-gray-600">SKU:
                                                            {{ $item->Product->sku }}</p>



                                                        @if ($item?->color)
                                                            <p class="text-sm text-gray-600">Color:
                                                                {{ $item->color }}</p>
                                                        @endif
                                                        @if ($item?->size)
                                                            <p class="text-sm text-gray-600">Size:
                                                                {{ $item->size }}</p>
                                                        @endif
                                                        <p class="text-sm text-gray-600">Qty:
                                                            {{ $item?->quantity ?? 1 }}</p>
                                                    </div>
                                                </div>
                                            </td>


                                            <td class="py-4 px-4 text-slate-900 font-medium">
                                                {{ config('app.currency.symbol') . number_format($item->total_price, 2) }}
                                            </td>
                                            <td class="py-4 px-4 text-slate-600">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}
                                            </td>

                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>

                    @endif

                </div>
            </div>
        @endif

    </main>
</div>
