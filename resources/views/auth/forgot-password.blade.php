<div>
    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-lg bg-white shadow-lg rounded-xl p-8">

            <!-- Logo -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Forgot Password</h2>
                <p class="text-gray-500 text-sm mt-2">
                    Enter your email and we will send you a password reset link.
                </p>
            </div>

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

            <!-- Form -->
            <form wire:submit.prevent="sendResetLink" class="space-y-5">
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email Address
                    </label>

                    <input type="text" wire:model.live.debounce.500ms="email"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-0 focus:outline-none"
                        placeholder="Enter your email">

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button -->

                <button type="submit" @if (!$email) disabled @endif wire:loading.attr="disabled"
                    wire:target="sendResetLink"
                    class="w-full py-3 px-6 text-white font-bold rounded-lg transition transform
                    flex justify-center items-center gap-2
                    disabled:bg-gray-400 disabled:cursor-not-allowed bg-[#00A6CC]
                    hover:scale-105 active:scale-95">

                    <span wire:loading.remove wire:target="sendResetLink">
                        Send Reset Link
                    </span>

                    <span wire:loading wire:target="sendResetLink" class="flex gap-4">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                        </svg>
                    </span>

                </button>
            </form>

            <!-- Back to login -->
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" wire:navigate class="text-sm text-[#00A6CC] hover:underline">
                    Back to Login
                </a>
            </div>

        </div>

    </div>
</div>
