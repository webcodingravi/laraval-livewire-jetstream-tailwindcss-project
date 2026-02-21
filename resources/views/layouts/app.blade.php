<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $meta_title ?? 'ShopHub' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <livewire:components.front.header />


    <main>
        {{ $slot }}
    </main>

    <x-front.footer />

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
        })
    </script>
    @stack('script')
</body>

</html>
