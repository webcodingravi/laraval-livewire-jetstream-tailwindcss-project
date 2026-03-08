<div>


    <div class="relative">
        <button wire:click="toggle"
            class="relative flex items-center p-3 rounded-lg hover:bg-slate-50 transition text-slate-700 gap-4">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">

                </path>

            </svg>


            @if (auth()->user()->unreadNotifications->count() > 0)
                {{-- <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full"></span> --}}
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
            <span class="text-sm font-medium">Notifications</span>

        </button>

        @if ($open)
            <div class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-50">

                <div class="p-2 font-medium border-b">
                    Notifications
                </div>

                <div class="max-h-64 overflow-y-auto">

                    @forelse($notifications as $notification)
                        <a href="#" wire:click="markAsRead('{{ $notification->id }}')"
                            class="block p-3 border-b hover:bg-gray-50
                       @if (is_null($notification->read_at)) bg-gray-100 @endif">

                            <div class="text-sm text-gray-700">
                                {{ $notification->data['message'] }}
                            </div>

                            <div class="text-xs text-gray-400 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>

                        </a>

                    @empty

                        <div class="p-3 text-sm text-gray-500">
                            No new notifications
                        </div>
                    @endforelse

                </div>
            </div>
        @endif
    </div>
</div>
