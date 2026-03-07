<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>

<body style="margin:0;padding:0;background:#f5f6fa;font-family:Arial,Helvetica,sans-serif;">
    @php
        $setting = \App\Models\SystemSetting::firstOrFail();
    @endphp

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f6fa;padding:30px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:8px;overflow:hidden">

                    <!-- Header -->
                    <tr>
                        <td
                            style="background:#111827;color:white;padding:20px;text-align:center;font-size:22px;font-weight:bold">
                            {{ $setting->website_name }}
                        </td>
                    </tr>

                    <!-- Title -->
                    <tr>
                        <td style="padding:30px">

                            <h2 style="margin-top:0">Order Confirmation</h2>

                            <p style="color:#555;font-size:14px">
                                Hello <strong>{{ $order->shipping_first_name }}
                                    {{ $order->shipping_last_name }}</strong>,
                            </p>

                            <p style="color:#555;font-size:14px">
                                Thank you for your purchase. Your order has been placed successfully.
                            </p>

                        </td>
                    </tr>

                    <!-- Order Summary -->
                    <tr>
                        <td style="padding:0 30px 20px 30px">

                            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse">

                                <tr style="background:#f3f4f6;font-size:14px">
                                    <th align="left">Order ID</th>
                                    <th align="left">Date</th>
                                    <th align="right">Total</th>
                                </tr>

                                <tr style="font-size:14px;color:#444">
                                    <td>#{{ $order->order_number }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td align="right">₹{{ number_format($order->total, 2) }}</td>
                                </tr>

                            </table>

                        </td>
                    </tr>

                    <!-- Message -->
                    <tr>
                        <td style="padding:0 30px 30px 30px;font-size:14px;color:#555">

                            Your invoice is attached with this email.

                            <br><br>

                            You can track your order from your account dashboard.

                        </td>
                    </tr>



                    <!-- Footer -->
                    <tr>
                        <td style="background:#f3f4f6;text-align:center;padding:20px;font-size:12px;color:#777">

                            <p style="margin:0">© {{ date('Y') }} {{ config('app.name') }}</p>

                            <p style="margin:5px 0 0 0">
                                If you have any questions, contact our support team.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
