<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100 ">
    @include('layouts.navigation')
    @csrf
    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-slate-100">
      
      <br>

      <h1 class="text-4xl text-black">Tabla Usuarios</h1>

      <br>

      <livewire:tabla-users />

    </div>
    <div id="app">
      @yield('content')
    </div>

    @livewireScripts
</body>

</html>