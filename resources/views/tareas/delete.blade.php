<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Eliminar Tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-white dark:text-white mb-4">
                    Confirmar Eliminación de la Tarea
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Persona de Contacto:</p>
                        <p class="text-white dark:text-white">{{ $tarea->persona_contacto }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Teléfono de Contacto:</p>
                        <p class="text-white dark:text-white">{{ $tarea->telefono_contacto }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Dirección:</p>
                        <p class="text-white dark:text-white">{{ $tarea->direccion }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Provincia:</p>
                        <p class="text-white dark:text-white">{{ optional($tarea->provincia)->nombre ?? 'Sin provincia' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Estado:</p>
                        <p class="text-white dark:text-white">
                            @switch($tarea->estado)
                                @case('N') Asignar Operario @break
                                @case('P') Pendiente @break
                                @case('R') En Progreso @break
                                @case('C') Completado @break
                                @default Desconocido
                            @endswitch
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Operario Asignado:</p>
                        <p class="text-white dark:text-white">{{ $tarea->usuario?->name ?? 'No asignado' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ auth()->user()->hasRole('Operario') ? route('tareas.misTareas') : route('tareas.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Cancelar
                    </a>

                    <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 dark:bg-red-600 hover:bg-red-600 dark:hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Confirmar Eliminación
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
