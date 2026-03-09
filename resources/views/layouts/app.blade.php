@php
    $setting = \App\Models\SystemSetting::firstOrFail();

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ $metaDescription ?? '' }}">

    <title>{{ $metaTitle ?? $setting->website_name }}</title>

    @if (!empty($setting->favicon))
        <link rel="icon" href="{{ asset('storage/uploads/settings/' . $setting->favicon) }}" type="image/x-icon">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />

    {{-- owl carousel style script --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <livewire:components.front.header :setting="$setting" />


    <main>
        {{ $slot }}
    </main>

    <x-front.footer :setting="$setting" />

    <button id="scrollUp"
        class="fixed bottom-5 right-5 w-10 h-10 bg-gray-800 hover:bg-indigo-600 text-white rounded-full flex items-center justify-center shadow-lg transition transform hover:scale-110">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 24 24">
        <path d="M4 12l1.41 1.41L11 7.83v12.34h2V7.83l5.59 5.58L20 12l-8-8-8 8z"/>
    </svg>
</button>

    @livewireScripts

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('alert', (data) => {
                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    text: data.text,
                    timer: 2000,
                    showConfirmButton: false
                })
            })
        });

    const scrollBtn = document.getElementById('scrollUp');

window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
        scrollBtn.classList.remove('scale-0');
        scrollBtn.classList.add('scale-100');
    } else {
        scrollBtn.classList.remove('scale-100');
        scrollBtn.classList.add('scale-0');
    }
});

scrollBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    @stack('script')
</body>

</html>
