<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50">
    <div class="flex h-screen bg-gray-100">
        <livewire:components.admin.sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">
            <livewire:components.admin.header />
            <!-- Main Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>


    @livewireScripts
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }


        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.querySelector('[onclick="toggleSidebar()"]');

            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>

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
</body>

</html>
