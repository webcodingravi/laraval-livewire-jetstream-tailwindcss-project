<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .container {
            width: 100%;
        }

        .header {
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .company {
            font-size: 22px;
            font-weight: bold;
        }

        .invoice-title {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
        }

        .meta {
            margin-top: 10px;
        }

        .address-box {
            width: 48%;
            display: inline-block;
            vertical-align: top;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background: #f2f2f2;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .total-section {
            margin-top: 20px;
            width: 300px;
            float: right;
        }

        .total-section td {
            border: none;
            padding: 6px 0;
        }

        .grand-total {
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>

</head>

<body>
    @php
        $setting = \App\Models\SystemSetting::firstOrFail();
    @endphp

    <div class="container">

        <!-- Header -->

        <div class="header">

            <table width="100%">
                <tr>

                    <td>
                        <div class="company">{{ $setting->website_name }}</div>
                        <div>
                            Email: {{ $setting->email }}<br>
                            Phone: +91-{{ $setting->phone_number }}
                        </div>
                    </td>

                    <td class="invoice-title">
                        Invoice
                    </td>

                </tr>
            </table>

        </div>

        <!-- Invoice Meta -->

        <table class="meta" width="100%">
            <tr>

                <td width="50%">
                    <strong>Invoice #:</strong> {{ $order->order_number }} <br>
                    <strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }} <br>
                    <strong>Payment Method:</strong>
                    {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
                </td>

                <td width="50%" align="right">
                    <strong>Customer</strong><br>
                    {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                    {{ $order->shipping_phone }}</br>
                    {{ $order->shipping_email }}<br>
                    {{ $order->shipping_address }}


                </td>

            </tr>
        </table>
        <!-- Products Table -->

        <table>

            <tr>
                <th align="left">Product</th>
                <th width="80">Qty</th>
                <th width="120">Price</th>
                <th width="120">Total</th>
            </tr>

            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td align="center">{{ $item->quantity }}</td>
                    <td align="right">₹{{ number_format($item->price, 2) }}</td>
                    <td align="right">₹{{ number_format($item->total_price, 2) }}</td>
                </tr>
            @endforeach

        </table>

        <!-- Totals -->

        <table class="total-section">

            <tr>
                <td>Subtotal</td>
                <td align="right">₹{{ number_format($order->subtotal, 2) }}</td>
            </tr>

            <tr>
                <td>Shipping</td>
                <td align="right">₹{{ number_format($order->shipping_amount, 2) }}</td>
            </tr>

            <tr class="grand-total">
                <td>Total</td>
                <td align="right">₹{{ number_format($order->total, 2) }}</td>
            </tr>

        </table>

        <div style="clear:both"></div>

        <!-- Footer -->

        <div class="footer">
            Thank you for your purchase! <br>
            This is a computer generated invoice.
        </div>

    </div>

</body>

</html>
