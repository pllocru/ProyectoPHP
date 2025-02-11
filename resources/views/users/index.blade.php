<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-8 lg:px-20">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-8">

                <!-- Botón para crear nuevo usuario -->
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Usuarios Registrados</h3>
                    <a href="{{ route('users.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Nuevo Usuario
                    </a>
                </div>

                <!-- Tabla de usuarios -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow">
                        <thead class="bg-blue-600 dark:bg-blue-900 text-white uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">DNI</th>
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-left">Teléfono</th>
                                <th class="py-3 px-6 text-left">Fecha de contratación</th>
                                <th class="py-3 px-6 text-left">Rol</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-300 text-sm font-light">
                            @foreach ($users as $user)
                            <tr class="border-b border-gray-300 dark:border-gray-600 odd:bg-gray-100 dark:odd:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="py-4 px-6">{{ $user->dni }}</td>
                                <td class="py-4 px-6">{{ $user->name }}</td>
                                <td class="py-4 px-6">{{ $user->email }}</td>
                                <td class="py-4 px-6">{{ $user->phone }}</td>
                                <td class="py-4 px-6">{{ $user->hire_date->format('d-m-Y') }}</td>
                                <td class="py-4 px-6">{{ $user->role }}</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex justify-center gap-4">
                                        <a href="{{ route('users.edit', ['user' => $user, 'page' => request('page', 1)]) }}" class="bg-yellow-500 dark:bg-yellow-600 hover:bg-yellow-600 dark:hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded shadow">
                                            Editar
                                        </a>
                                        <a href="{{ route('users.show', ['user' => $user, 'page' => request('page', 1)]) }}" class="bg-red-500 dark:bg-red-600 hover:bg-red-600 dark:hover:bg-red-700 text-white font-bold py-1 px-3 rounded shadow">
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>

                <!-- Mensaje si no hay usuarios -->
                @if ($users->isEmpty())
                <div class="text-center text-gray-500 dark:text-gray-400 py-6">
                    No hay usuarios registrados.
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
