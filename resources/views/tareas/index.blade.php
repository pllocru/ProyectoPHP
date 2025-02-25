<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Tareas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-8 lg:px-20">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-8">

                <!-- Botón para crear una nueva tarea -->
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Tareas Registradas</h3>
                </div>

                <!-- Tabla de tareas -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow">
                        <thead class="bg-blue-600 dark:bg-blue-900 text-white uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">Descripcion</th>
                                <th class="py-3 px-6 text-left">Estado</th>
                                <th class="py-3 px-6 text-left">Asignado a</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-300 text-sm font-light">
                            @foreach ($tareas as $tarea)
                            <tr class="border-b border-gray-300 dark:border-gray-600 odd:bg-gray-100 dark:odd:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="py-4 px-6">{{ $tarea->descripcion }}</td>
                                <td class="py-4 px-6">{{ ucfirst($tarea->estado) }}</td>
                                <td class="py-4 px-6">{{ $tarea->usuario?->name ?? 'No asignado' }}</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex justify-center gap-4">
                                        <a href="{{ route('tareas.show', $tarea) }}" class="bg-info-500 dark:bg-info-600 hover:bg-info-600 dark:hover:bg-info-700 text-white font-bold py-1 px-3 rounded shadow">
                                            Ver
                                        </a>
                                        <a href="{{ route('tareas.edit', ['tarea' => $tarea, 'page' => request('page', 1)]) }}" class="bg-yellow-500 dark:bg-yellow-600 hover:bg-yellow-600 dark:hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded shadow">
                                            Editar
                                        </a>
                                        <form action="{{ route('tareas.destroy', $tarea) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea? Esta acción no se puede deshacer.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 dark:bg-red-600 hover:bg-red-600 dark:hover:bg-red-700 text-white font-bold py-1 px-3 rounded shadow">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $tareas->links() }}
                </div>

                <!-- Mensaje si no hay tareas -->
                @if ($tareas->isEmpty())
                <div class="text-center text-gray-500 dark:text-gray-400 py-6">
                    No hay tareas registradas.
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
