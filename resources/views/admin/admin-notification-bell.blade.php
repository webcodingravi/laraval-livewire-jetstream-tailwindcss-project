<div>
    <div class="relative" wire:poll.5s>
        <button wire:click="toggle" class="relative p-2 hover:bg-gray-100 rounded-lg">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>

            @if ($notifications->count() > 0)
                {{-- <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full"></span> --}}
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1">
                    {{ $notifications->count() }}
                </span>
            @endif
        </button>

        @if ($open)
            <div class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                <div class="p-2 font-medium border-b">Notifications</div>
                <div class="max-h-64 overflow-y-auto">
                    @forelse($notifications as $notification)
                        <div class="p-3 border-b hover:bg-gray-50 flex justify-between items-start">
                            <div class="text-sm text-gray-700">{{ $notification->data['message'] }}</div>
                            <button wire:click="markAsRead('{{ $notification->id }}')"
                                class="ml-2 text-xs text-blue-600 hover:underline">Mark read</button>
                        </div>
                    @empty
                        <div class="p-3 text-sm text-gray-500">No new notifications</div>
                    @endforelse
                </div>
            </div>
        @endif
    </div>
</div>
