<div>
    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 text-green-600 text-sm bg-green-50 p-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-rose-600 text-sm bg-rose-50 p-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif


            <h2 class="text-2xl font-bold text-center mb-6">
                Reset Password
            </h2>

            <form wire:submit.prevent="resetPassword">

                <input type="hidden" wire:model="token">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>

                    <input type="text" wire:model.live.debounce.500ms="email" placeholder="Enter Your Email Id..."
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-0 focus:outline-none">
                    @error('email')
                        <p class="mt-2 text-sm text-rose-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>

                    <input type="password" wire:model.live.debounce.500ms="password" placeholder="••••••••"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-0 focus:outline-none">
                    @error('password')
                        <p class="mt-2 text-sm text-rose-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>

                    <input type="password" wire:model.live.debounce.500ms="password_confirmation" placeholder="••••••••"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-0 focus:outline-none">

                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-rose-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="resetPassword"
                    class="w-full py-3 px-6 text-white font-bold rounded-lg transition transform
                    flex justify-center items-center gap-2
                    disabled:bg-gray-400 disabled:cursor-not-allowed bg-[#00A6CC]
                    hover:scale-105 active:scale-95">

                    <span wire:loading.remove wire:target="resetPassword">
                        Reset Password
                    </span>

                    <span wire:loading wire:target="resetPassword" class="flex gap-4">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                        </svg>
                    </span>

                </button>

            </form>

        </div>

    </div>

</div>
