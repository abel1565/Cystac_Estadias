<x-app-layout>
    <x-slot name="header">
       
        <h2 class="font-semibold text-xl text-blue-500 leading-tight">
            {{ __('LInk2') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-600" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Prueba") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 bg-blue-600" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Prueba") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>