<div>
    <div class="max-w-3xl mx-auto py-12">
        <div class="bg-green-50 p-8 rounded-xl shadow">
            <h1 class="text-3xl font-bold mb-4 text-green-800">Order Confirmed!</h1>
            <p class="text-gray-700 mb-6">
                Thank you, {{ $order->shipping_first_name }}. Your order #{{ $order->order_number }} has been placed
                successfully.
            </p>

            <a href="{{ route('home') }}"
                class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
