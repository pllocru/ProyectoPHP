<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de la Tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">

            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-6">Información de la Tarea</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p class="font-semibold text-white">Persona de Contacto:</p>
                    <p class="text-gray-300">{{ $tarea->persona_contacto }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white">Teléfono de Contacto:</p>
                    <p class="text-gray-300">{{ $tarea->telefono_contacto }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white">Correo de Contacto:</p>
                    <p class="text-gray-300">{{ $tarea->correo_contacto }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white">Dirección:</p>
                    <p class="text-gray-300">{{ $tarea->direccion }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white">Población:</p>
                    <p class="text-gray-300">{{ $tarea->poblacion }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white">Código Postal:</p>
                    <p class="text-gray-300">{{ $tarea->codigo_postal }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white">Provincia:</p>
                    <p class="text-gray-300">{{ optional($tarea->provincia)->nombre ?? 'Sin provincia' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white">Estado:</p>
                    <p class="text-gray-300">
                        @switch($tarea->estado)
                            @case('N') Asignar Operario @break
                            @case('P') Pendiente @break
                            @case('R') En Progreso @break
                            @case('C') Completado @break
                            @default Desconocido
                        @endswitch
                    </p>
                </div>

                <div class="md:col-span-2">
                    <p class="font-semibold text-white">Descripción:</p>
                    <p class="text-gray-300">{{ $tarea->descripcion }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white">Operario Asignado:</p>
                    <p class="text-gray-300">{{ $tarea->usuario?->name ?? 'No asignado' }}</p>
                </div>

 

                <div class="md:col-span-2">
                    <p class="font-semibold text-white">Anotaciones Anteriores:</p>
                    <p class="text-gray-300">{{ $tarea->anotaciones_anteriores ?? 'Sin anotaciones' }}</p>
                </div>

            </div>
            
            <div class="mt-8 flex justify-end">
            <a href="{{ auth()->user()->hasRole('Operario') ? route('tareas.misTareas') : route('tareas.index') }}"
                class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded shadow">
                Volver
            </a>
            </div>
            @if ($existeResumen)
            <a href="{{ route('tareas.descargarResumen', $tarea) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded shadow">
                Descargar Resumen
            </a>
        @else
            <button class="text-gray-400" disabled>
                Resumen no disponible
            </button>
        @endif


        </div>
    </div>
</x-app-layout>
