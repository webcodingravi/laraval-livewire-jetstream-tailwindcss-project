<x-guest-layout>
    <livewire:components.front.header />
    {{-- <x-authentication-card> --}}
    {{-- <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot> --}}

    {{-- <x-validation-errors class="mb-4" /> --}}

    <div class="flex justify-center items-center h-screen bg-slate-100">
        <form action="{{ route('register') }}" method="POST" class="w-6/12 bg-white p-4 rounded flex flex-col gap-4">
            @csrf
            <div class="flex flex-col gap-1">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Please Enter your name.."
                    class="border border-slate-200 rounded p-4">
                @error('name')
                    <span class="text-rose-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label>Email</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="Please Enter your email.."
                    class="border border-slate-200 rounded p-4">
                @error('email')
                    <span class="text-rose-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label>Password</label>
                <input type="password" name="password" placeholder="Please Enter Password"
                    class="border border-slate-200 rounded p-4">
                @error('password')
                    <span class="text-rose-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label>Confirmed Password</label>
                <input type="password" name="password_confirmation" placeholder="Please Enter Password"
                    class="border border-slate-200 rounded p-4">
                @error('password_confirmation')
                    <span class="text-rose-500">{{ $message }}</span>
                @enderror
            </div>


            <button class="bg-indigo-500 rounded px-6 py-2 text-white">Register</button>
        </form>
    </div>



    {{-- <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form> --}}
    {{-- </x-authentication-card> --}}
    <x-front.footer />
</x-guest-layout>
