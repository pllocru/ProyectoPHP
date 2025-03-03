<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Detalles de la Cuota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-white dark:text-white mb-4">
                    Información de la Cuota
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Cliente:</p>
                        <p class="text-white dark:text-white">{{ $cuota->cliente->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Concepto:</p>
                        <p class="text-white dark:text-white">{{ $cuota->concepto }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Fecha de Emisión:</p>
                        <p class="text-white dark:text-white">{{ $cuota->fecha_emision->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Importe (EUR):</p>
                        <p class="text-white dark:text-white">{{ number_format($cuota->importe, 2) }} EUR</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Pagada:</p>
                        <p class="text-white dark:text-white">{{ $cuota->pagada ? 'Sí' : 'No' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Notas:</p>
                        <p class="text-white dark:text-white">{{ $cuota->notas ?? 'Sin notas' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('cuotas.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Volver
                    </a>

                    <a href="{{ route('cuotas.pdf', $cuota) }}"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Descargar PDF
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>