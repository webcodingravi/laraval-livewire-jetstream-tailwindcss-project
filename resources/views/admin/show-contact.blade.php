<div>

    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">All Contact</h2>
                <p class="text-gray-600 mt-1">Manage your Website Contact Us Form</p>
            </div>

        </div>


        <!-- Pages Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">S.NO.</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Name</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Email</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Phone Number</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Subject</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Message</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Created Date</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contactUs->isNotEmpty())
                            @foreach ($contactUs as $contact)
                                <tr class=" border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ ($contactUs->currentPage() - 1) * $contactUs->perPage() + $loop->iteration }}
                                        </p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                {{ $contact->name }}</p>

                                        </div>
                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $contact->email }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $contact->subject }}</p>


                                    </td>

                                    <td class="py-4 px-4">
                                        <p class="font-semibold text-gray-900">
                                            {{ $contact->message }}</p>


                                    </td>

                                    <td class="py-4 px-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y') }}

                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center pt-4">Empty Contact Us</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4">
                {{ $contactUs->links() }}
            </div>
        </div>

    </main>
</div>
