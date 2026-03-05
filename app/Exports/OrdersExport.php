<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return OrderItem::with(['orders', 'Product'])->get();
    }

    public function map($item): array
    {
        return [
            $item->orders?->id ?? 'N/A',
            $item->orders->order_number ?? 'N/A',
            $item->product_name,
            $item->product->sku ?? 'N/A',
            $item->quantity,
            $item->color ?? 'N/A',
            $item->size ?? 'N/A',
            $item->orders->created_at->format('Y-m-d') ?? 'N/A',
            $item->orders->shipping_amount ?? 'N/A',
            $item->orders->discount ?? 'N/A',
            $item->orders->discount_code ?? 'N/A',
            $item->orders->total,
            $item->orders->payment_status,
            $item->orders->payment_method,
            $item->orders->transaction_id ?? 'N/A',
            $item->orders->status,
            $item->orders->shipping_first_name.' '.$item->orders?->shipping_last_name,
            $item->orders->shipping_phone,
            $item->orders->shipping_email,
            $item->orders->shipping_city,
            $item->orders->shipping_state,
            $item->orders->shipping_zip,
            $item->orders->shipping_country,
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Order Number', 'Product Name', 'SKU', 'Qty', 'Color', 'Size', 'Order Date', 'Shipping Amount', 'Discount', 'Discount Code', 'Total Amount', 'Payment Status', 'Payment Method', 'Transation_id', 'Status', 'Fullname', 'Mobile', 'Email', 'City', 'State', 'Country', 'Pincode'];
    }
}
