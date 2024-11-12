<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-slate-100">
            <br>
            <h1 class="text-4xl text-black text-center">Uso de Api para documentos XML</h1>
            <br>
            <div class="flex flex-col sm:flex-row w-full sm:w-3/4 md:w-1/2 lg:w-1/3 mx-auto p-4 m-2 rounded-lg border-2 justify-center">
                <form id="formDescarga" action="{{ route('Descarga_XML') }}" method="POST" enctype="multipart/form-data" class="w-full">
                    @csrf
                    <div class="mb-4">
                        <label for="rfc" class="block text-gray-700">RFC:</label>
                        <input class="w-full rounded-full border-gray-300 p-2" type="text" name="rfc" id="rfc" placeholder="RFC">
                    </div>
                    <div class="mb-4">
                        <label for="Finicial" class="block text-gray-700">Fecha Inicial:</label>
                        <input class="w-full rounded-full border-gray-300 p-2" type="date" name="Finicial" id="Finicial">
                    </div>
                    <div class="mb-4">
                        <label for="Ffinal" class="block text-gray-700">Fecha Final:</label>
                        <input class="w-full rounded-full border-gray-300 p-2" type="date" name="Ffinal" id="Ffinal">
                    </div>
                    <div class="text-center">
                        <input class="w-full sm:w-auto rounded-md bg-gray-600 px-4 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="app">
        @yield('content')
    </div>
    @livewireScripts
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('formDescarga').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevenir el envío normal del formulario

            let formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar notificación de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Descarga exitosa',
                        text: data.message,
                    });

                    // Crear un enlace de descarga
                    let link = document.createElement('a');
                    link.href = 'data:application/zip;base64,' + data.fileContent;
                    link.download = data.fileName;
                    link.click();
                } else {
                    // Mostrar notificación de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema con la descarga'
                });
            });
        });
    </script>

</body>

</html>
