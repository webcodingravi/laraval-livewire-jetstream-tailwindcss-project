<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select('id', 'fullname', 'email', 'phone_number', 'created_at')
            ->with('address:id,user_id,city,state,zip_code,country,address')
            ->where('role', 'user')
            ->get();
    }

    public function map($user): array
    {

        return [
            $user->id,
            $user->fullname,
            $user->email,
            $user->phone_number,
            $user->address->city ?? '',
            $user->address->state ?? '',
            $user->address->zip_code ?? '',
            $user->address->country ?? '',
            $user->address->address ?? '',
            $user->created_at->format('Y-m-d'),

        ];
    }

    public function headings(): array
    {
        return ['ID', 'FullName', 'Email', 'Phone Number', 'City', 'State', 'Pincode', 'Country', 'Address', 'Created Date'];

    }
}
