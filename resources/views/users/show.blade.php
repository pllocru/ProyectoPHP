<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Empleado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">

                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                    Información del Empleado
                </h3>

                <!-- Datos del empleado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-medium">DNI:</p>
                        <p class="text-gray-900 dark:text-white">{{ $user->dni }}</p>
                    </div>

                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-medium">Nombre:</p>
                        <p class="text-gray-900 dark:text-white">{{ $user->name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-medium">Email:</p>
                        <p class="text-gray-900 dark:text-white">{{ $user->email }}</p>
                    </div>

                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-medium">Teléfono:</p>
                        <p class="text-gray-900 dark:text-white">{{ $user->phone }}</p>
                    </div>

                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-medium">Dirección:</p>
                        <p class="text-gray-900 dark:text-white">{{ $user->address }}</p>
                    </div>

                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-medium">Fecha de Contratación:</p>
                        <p class="text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($user->hire_date)->format('d-m-Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-700 dark:text-gray-300 font-medium">Rol:</p>
                        <p class="text-gray-900 dark:text-white">{{ $user->getRoleNames()->first() }}</p>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="mt-6 flex justify-end space-x-4">
                    <!-- Botón Volver -->
                    <a href="{{ route('users.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Volver
                    </a>

                    <!-- Botón Eliminar con Confirmación -->
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 dark:bg-red-600 hover:bg-red-600 dark:hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Eliminar
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
