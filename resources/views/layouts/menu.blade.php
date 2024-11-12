<div class="relative">
    <!-- Checkbox para controlar la visibilidad del menú -->
    <input type="checkbox" id="menu-toggle" class="hidden">

    <!-- Botón para mostrar el menú -->
    <label for="menu-toggle" class="ml-4 cursor-pointer inline-flex items-center px-3  text-sm leading-4 font-medium  text-black hover:text-gray-500 focus:outline-none transition ease-in-out duration-150" aria-label="Open menu">
        <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
        </svg>
    </label>

    <!-- Menú lateral -->
    <div id="sidebar" class="overflow-y-scroll bg-stone-200 min-h-screen w-64 fixed top-0 left-0 transform -translate-x-full transition-transform duration-300 z-50 ">
        <div class="pt-3 relative">
            <!-- Botón para ocultar el menú -->
            <label for="menu-toggle" class="absolute top-3 right-3 text-black cursor-pointer" aria-label="Close menu">
                <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path>
                </svg>
            </label>
            <div class="flex flex-col items-center justify-center my-4 text-gray-600 ">
                <x-logo></x-logo>
                <div class="ext-center mt-2 text-xs break-words normal-case font-medium">{{ Auth::user()->email }}</div>
            </div>

            <!-- Links del menú basados en el rol del usuario -->
            <div class="px-4">
                <button onclick="toggleDropdown('dropdown1')" class="flex items-center text-gray-500 hover:bg-gray-100 cursor-pointer py-3 mb-2 text-sm w-full">
                    <svg data-slot="icon" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-5-2a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM8 9c-1.825 0-3.422.977-4.295 2.437A5.49 5.49 0 0 0 8 13.5a5.49 5.49 0 0 0 4.294-2.063A4.997 4.997 0 0 0 8 9Z"></path>
                    </svg>
                    Trabajadores
                </button>
                <div id="dropdown1" class="hidden pl-10">
                    <div class="text-gray-700 py-2 hover:bg-gray-100 cursor-pointer text-sm flex ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg><a href="{{ route('pag1') }}" class="ml-2"> Descarga XML</a>
                    </div>
                    <div class="text-gray-700 py-2 hover:bg-gray-100 cursor-pointer text-sm flex">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg><a href="{{ route('tablausers') }}" class="ml-2"> Usuarios</a>
                    </div>

                </div>

                <button onclick="toggleDropdown('dropdown2')" class="flex items-center text-gray-500 hover:bg-gray-100 cursor-pointer py-3 mb-2 text-sm w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-3">
                        <path fill-rule="evenodd" d="M5.478 5.559A1.5 1.5 0 0 1 6.912 4.5H9A.75.75 0 0 0 9 3H6.912a3 3 0 0 0-2.868 2.118l-2.411 7.838a3 3 0 0 0-.133.882V18a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0 0 17.088 3H15a.75.75 0 0 0 0 1.5h2.088a1.5 1.5 0 0 1 1.434 1.059l2.213 7.191H17.89a3 3 0 0 0-2.684 1.658l-.256.513a1.5 1.5 0 0 1-1.342.829h-3.218a1.5 1.5 0 0 1-1.342-.83l-.256-.512a3 3 0 0 0-2.684-1.658H3.265l2.213-7.191Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v6.44l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 0 1 1.06-1.06l1.72 1.72V3a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                    </svg>
                    Facturas
                </button>
                <div id="dropdown2" class="hidden pl-10">
                    <div class="text-gray-700 py-2 hover:bg-gray-100 cursor-pointer text-sm flex ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6  flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg><a href="{{ route('Nominas') }}" class="ml-2"> Nominas</a>
                    </div>
                    <div class="text-gray-700 py-2 hover:bg-gray-100 cursor-pointer text-sm flex">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6  flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg><a href="{{ route('Ingresos') }}" class="ml-2">Ingresos</a>
                    </div>
                    <div class="text-gray-700 py-2 hover:bg-gray-100 cursor-pointer text-sm flex">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6  flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg><a href="{{ route('Egresos') }}" class="ml-2"> Egresos</a>
                    </div>
                </div>
                <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                    <svg data-slot="icon" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-5-2a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM8 9c-1.825 0-3.422.977-4.295 2.437A5.49 5.49 0 0 0 8 13.5a5.49 5.49 0 0 0 4.294-2.063A4.997 4.997 0 0 0 8 9Z"></path>
                    </svg>
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <x-dropdown-link :href="route('logout')" class="flex items-center" onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>

                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function toggleDropdown(id) {
        var element = document.getElementById(id);
        element.classList.toggle('hidden');
    }
</script>

<!-- CSS -->
<style>
    /* Estilo para el checkbox oculto */
    #menu-toggle {
        display: none;
    }

    /* Menú lateral oculto por defecto */
    #sidebar {
        transform: translateX(-100%);
    }

    /* Menú lateral visible cuando el checkbox está marcado */
    #menu-toggle:checked~#sidebar {
        transform: translateX(0);
    }

    /* Transición suave para el menú lateral */
    .transition-transform {
        transition: transform 0.3s ease;
    }

    /* Botón de cerrar menú */
    .close-menu-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    /* Ajustar el tamaño del botón */
    .close-menu-btn svg {
        width: 1.5rem;
        height: 1.5rem;
    }

    /* Estilo para hover en todo el ancho del menú */
    .hover\\:bg-gray-100:hover {
        background-color: #f5f5f5;
        width: 100%;
    }
</style>