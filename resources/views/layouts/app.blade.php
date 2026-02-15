<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New App</title>
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

    <script src="https://cdn.jsdelivr.net/npm/froala-editor@4.2.0/js/froala_editor.min.js"></script>
    @stack('script')
</body>

</html>
