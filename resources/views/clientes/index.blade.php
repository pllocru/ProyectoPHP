<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-8 lg:px-20">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-8">

                <!-- Botón para crear un nuevo cliente -->
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Clientes Registrados</h3>
                    <a href="{{ route('clientes.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Nuevo Cliente
                    </a>
                </div>

                <!-- Tabla de clientes -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow">
                        <thead class="bg-blue-600 dark:bg-blue-900 text-white uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">CIF</th>
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left">Teléfono</th>
                                <th class="py-3 px-6 text-left">Correo</th>
                                <th class="py-3 px-6 text-left">Cuenta Corriente</th>
                                <th class="py-3 px-6 text-left">País</th>
                                <th class="py-3 px-6 text-left">Moneda</th>
                                <th class="py-3 px-6 text-left">Cuota Mensual</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-300 text-sm font-light">
                            @foreach ($clientes as $cliente)
                            <tr class="border-b border-gray-300 dark:border-gray-600 odd:bg-gray-100 dark:odd:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="py-4 px-6">{{ $cliente->cif }}</td>
                                <td class="py-4 px-6">{{ $cliente->nombre }}</td>
                                <td class="py-4 px-6">{{ $cliente->telefono }}</td>
                                <td class="py-4 px-6">{{ $cliente->correo }}</td>
                                <td class="py-4 px-6">{{ $cliente->cuenta_corriente }}</td>
                                <td class="py-4 px-6">{{ $cliente->pais->nombre }}</td>
                                <td class="py-4 px-6">{{ $cliente->moneda }}</td>
                                <td class="py-4 px-6">{{ number_format($cliente->importe_cuota_mensual, 2) }} {{ $cliente->moneda }}</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex justify-center gap-4">
                                        <a href="{{ route('clientes.edit', ['cliente' => $cliente, 'page' => request('page', 1)]) }}" class="bg-yellow-500 dark:bg-yellow-600 hover:bg-yellow-600 dark:hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded shadow">
                                            Editar
                                        </a>
                                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente? Esta acción no se puede deshacer.');">
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
                    {{ $clientes->links() }}
                </div>

                <!-- Mensaje si no hay clientes -->
                @if ($clientes->isEmpty())
                <div class="text-center text-gray-500 dark:text-gray-400 py-6">
                    No hay clientes registrados.
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
