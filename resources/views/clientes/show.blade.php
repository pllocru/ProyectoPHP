<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Detalle del Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-white dark:text-white mb-4">
                    Información del Cliente
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">CIF:</p>
                        <p class="text-white dark:text-white">{{ $cliente->cif }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Nombre:</p>
                        <p class="text-white dark:text-white">{{ $cliente->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Teléfono:</p>
                        <p class="text-white dark:text-white">{{ $cliente->telefono }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Correo Electrónico:</p>
                        <p class="text-white dark:text-white">{{ $cliente->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Cuenta Corriente:</p>
                        <p class="text-white dark:text-white">{{ $cliente->cuenta_corriente }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">País:</p>
                        <p class="text-white dark:text-white">{{ $cliente->pais->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Moneda:</p>
                        <p class="text-white dark:text-white">{{ $cliente->moneda }}</p>
                    </div>
                    <div>
                        <p class="text-gray-300 dark:text-gray-400 font-medium">Importe Cuota Mensual (EUR):</p>
                        <p class="text-white dark:text-white">{{ number_format($cliente->importe_cuota_mensual, 2) }} EUR</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('clientes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
