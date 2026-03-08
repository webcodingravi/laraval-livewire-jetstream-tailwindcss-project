<div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-slate-900"> Orders</h2>

        </div>

        <!-- Orders Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Order Number(#)</th>
                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Total
                            Amount({{ config('app.currency.symbol') }})</th>

                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Payment Method
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Delivery Status
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Order Date
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-slate-700">Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) > 0)
                        @foreach ($orders as $order)
                            <tr class="border-b border-slate-100 hover:bg-slate-50">
                                <td class="py-4 px-4 text-slate-900 font-medium">
                                    #{{ $order->order_number }}
                                </td>

                                <td class="py-4 px-4 text-slate-900 font-medium">
                                    {{ config('app.currency.symbol') . number_format($order->total, 2) }}
                                </td>

                                <td class="py-4 px-4 text-slate-900 font-medium">
                                    {{ ucfirst($order->payment_method) }}
                                </td>

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

                                <td class="py-4 px-4 text-slate-600">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                                </td>

                                <td class="py-4 px-4 text-slate-600">
                                    <button wire:click="view({{ $order->id }})"
                                        class="bg-[#47b2c8] rounded px-3 py-2 text-white active:scale-95 transition-all duration-300">
                                        <i class="ri-eye-line"></i> View Detail
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center p-4">
                            <td colspan="8">No Record Found !</td>
                        </tr>
                    @endif


                </tbody>
            </table>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>

        <!-- Empty State -->
        <div class="text-center py-12" style="display: none;">
            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <p class="mt-4 text-slate-600">No orders yet</p>
            <a href="#" class="text-blue-600 hover:text-blue-700 mt-2 inline-block">Start
                Shopping</a>
        </div>
    </div>

    {{-- open modal --}}
    @if ($isOpen)
        <div
            class="bg-black/50 flex fixed justify-center inset-0 items-center animate__animated animate__fadeIn z-[9999]">
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
                            #{{ $singleOrder->order_number }}
                        </div>
                    </div>

                    @if (!empty($singleOrder->transaction_id))
                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Transaction Id :</h2>
                            </div>

                            <div>
                                {{ $singleOrder->transaction_id }}
                            </div>
                        </div>
                    @endif

                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Name :</h2>
                        </div>

                        <div>
                            {{ $singleOrder->shipping_first_name . ' ' . $singleOrder->shipping_last_name }}
                        </div>
                    </div>

                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Mobile :</h2>
                        </div>

                        <div>
                            +91-{{ $singleOrder->shipping_phone }}
                        </div>
                    </div>

                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Email :</h2>
                        </div>

                        <div>
                            {{ $singleOrder->shipping_email }}
                        </div>
                    </div>


                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">City :</h2>
                        </div>

                        <div>
                            {{ $singleOrder->shipping_city }}
                        </div>
                    </div>

                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">State :</h2>
                        </div>

                        <div>
                            {{ $singleOrder->shipping_state }}
                        </div>
                    </div>


                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Country :</h2>
                        </div>

                        <div>
                            {{ $singleOrder->shipping_country }}
                        </div>
                    </div>

                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Pincode :</h2>
                        </div>

                        <div>
                            {{ $singleOrder->shipping_zip }}
                        </div>
                    </div>

                    @if (!empty($singleOrder->discount_code))
                        <div class="flex border-b border-b-slate-200 p-4 gap-3">
                            <div>
                                <h2 class="font-medium text-md">Discount Code :</h2>
                            </div>

                            <div>
                                {{ $singleOrder->discount_code }}
                            </div>
                        </div>
                    @endif


                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Shipping Amount({{ config('app.currency.symbol') }}) :
                            </h2>
                        </div>

                        <div>
                            {{ config('app.currency.symbol') . number_format($singleOrder->shipping_amount, 2) ?? '0.00' }}
                        </div>
                    </div>


                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Total Amount({{ config('app.currency.symbol') }}) :
                            </h2>
                        </div>

                        <div>
                            {{ config('app.currency.symbol') . number_format($singleOrder->total, 2) }}
                        </div>
                    </div>

                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Payment Status
                            </h2>
                        </div>

                        <div>
                            @if ($singleOrder->is_payment)
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
                            {{ ucfirst($singleOrder->payment_method) }}
                        </div>
                    </div>


                    <div class="flex border-b border-b-slate-200 p-4 gap-3">
                        <div>
                            <h2 class="font-medium text-md">Status
                            </h2>
                        </div>

                        <div>
                            <td class="py-4 px-4">
                                @if ($singleOrder->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Pending
                                    </span>
                                @elseif($singleOrder->status === 'inprogress')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        In-Progress
                                    </span>
                                @elseif($singleOrder->status === 'delivered')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Delivered
                                    </span>
                                @elseif($singleOrder->status === 'cancelled')
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
                            {{ \Carbon\Carbon::parse($singleOrder->created_at)->format('M d, Y') }}
                        </div>
                    </div>


                </div>



                @if (!empty($singleOrder->orderItems))
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

                                @foreach ($singleOrder->orderItems as $item)
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


                                                    @php
                                                        $hasReviewed = \App\Models\ProductRating::where(
                                                            'user_id',
                                                            auth()->id(),
                                                        )
                                                            ->where('product_id', $item->product->id)
                                                            ->exists();
                                                    @endphp


                                                    @if ($singleOrder->status === 'delivered' && !$hasReviewed )
                                                        <livewire:components.user.rating :product="$item->product" />
                                                    @endif
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


</div>
