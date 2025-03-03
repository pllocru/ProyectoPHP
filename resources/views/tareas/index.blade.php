<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Tareas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-8 lg:px-20">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-8">


                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                        class="bg-green-500 text-white px-4 py-3 rounded-md shadow-md mb-4 transition-opacity duration-500">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif


                <!-- Título y Botón de Añadir (solo visible para Administradores) -->
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Tareas Registradas</h3>



                    @role('Administrador')
                    <a href="{{ route('tareas.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                        + Añadir Tarea
                    </a>
                    @endrole
                </div>

                <!-- Tabla de tareas -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow">
                        <thead class="bg-blue-600 dark:bg-blue-900 text-white uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">Descripción</th>
                                <th class="py-3 px-6 text-left">Estado</th>
                                <th class="py-3 px-6 text-left">Asignado a</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-300 text-sm font-light">
                            @foreach ($tareas as $tarea)
                                <tr
                                    class="border-b border-gray-300 dark:border-gray-600 odd:bg-gray-100 dark:odd:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td class="py-4 px-6">{{ $tarea->descripcion }}</td>
                                    <td class="py-4 px-6">
                                        @switch($tarea->estado)
                                            @case('N')
                                                <span class="bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                                    Asignar Operario
                                                </span>
                                                @break
                                            @case('P')
                                                <span class="bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                                    Pendiente
                                                </span>
                                                @break
                                            @case('R')
                                                <span class="bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                                    En Progreso
                                                </span>
                                                @break
                                            @case('C')
                                                <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                                    Completado
                                                </span>
                                                @break
                                            @default
                                                <span class="bg-gray-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                                    Desconocido
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="py-4 px-6">{{ $tarea->usuario?->name ?? 'No asignado' }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-4">

                                            <!-- Botón Ver -->
                                            <a href="{{ route('tareas.show', $tarea) }}"
                                                class="bg-blue-500 dark:bg-blue-600 hover:bg-blue-600 dark:hover:bg-blue-700 text-white font-bold py-1 px-3 rounded shadow">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>

                                            <!-- Botón Realizar (solo Operarios) -->
                                            @role('Operario')
                                            @if ($tarea->estado === 'P' && $tarea->usuario_id === auth()->user()->id)
                                                <a href="{{ route('tareas.realizar', $tarea) }}"
                                                    class="bg-green-500 dark:bg-green-600 hover:bg-green-600 dark:hover:bg-green-700 text-white font-bold py-1 px-3 rounded shadow flex items-center gap-1">
                                                    <i class="fas fa-check-circle"></i> Realizar
                                                </a>
                                            @endif
                                            @endrole

                                            <!-- Botones solo para Administradores -->
                                            @role('Administrador')
                                            <a href="{{ route('tareas.edit', ['tarea' => $tarea, 'page' => request('page', 1)]) }}"
                                                class="bg-yellow-500 dark:bg-yellow-600 hover:bg-yellow-600 dark:hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded shadow flex items-center gap-1">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>

                                            <a href="{{ route('tareas.delete', $tarea) }}"
                                                class="bg-red-500 dark:bg-red-600 hover:bg-red-600 dark:hover:bg-red-700 text-white font-bold py-1 px-3 rounded shadow flex items-center gap-1">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </a>


                                            @if ($tarea->estado === 'N')
                                                <a href="{{ route('tareas.asignarOperario', $tarea) }}"
                                                    class="bg-purple-500 dark:bg-purple-600 hover:bg-purple-600 dark:hover:bg-purple-700 text-white font-bold py-1 px-3 rounded shadow flex items-center gap-1">
                                                    <i class="fas fa-user-plus"></i> Asignar Operario
                                                </a>
                                            @endif
                                            @endrole

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>