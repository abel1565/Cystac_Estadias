<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-slate-200">
        @include('layouts.navigation')

        <main class="py-12">
            <br>
            <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Informacion del perfil') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Actualiza la información de perfil y la dirección de correo electrónico de tu cuenta.") }}
                    </p>
                </header>

                <!-- Formulario de actualización de usuario -->
                <form method="post" action="{{ route('edituser.update', $user->id) }}" class="mt-6 space-y-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    @csrf
                    @method('patch') <!-- Cambia esto a 'post' si la ruta lo requiere -->

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="rol" :value="__('Rol')" />
                        <x-text-input id="rol" name="rol" type="text" class="mt-1 block w-full" :value="old('rol', $user->rol)" required autofocus autocomplete="rol" />
                        <x-input-error class="mt-2" :messages="$errors->get('rol')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                       
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Guardar Datos') }}</x-primary-button>

                        @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Guardado.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </main>

        <div id="app">
            @yield('content')
        </div>
    </div>

    @livewireScripts
</body>

</html>
