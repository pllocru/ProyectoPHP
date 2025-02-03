<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Empleados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-15">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                
                <!-- Botón para crear nuevo empleado -->
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Empleados Registrados</h3>
                    <a href="{{ route('employees.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Nuevo Empleado
                    </a>
                </div>

                <!-- Tabla de empleados -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow">
                        <thead class="bg-blue-600 dark:bg-blue-900 text-white uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">DNI</th>
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-left">Teléfono</th>
                                <th class="py-3 px-6 text-left">Tipo</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-300 text-sm font-light">
                            @foreach ($employees as $employee)
                                <tr class="border-b border-gray-300 dark:border-gray-600 odd:bg-gray-100 dark:odd:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td class="py-4 px-6">{{ $employee->dni }}</td>
                                    <td class="py-4 px-6">{{ $employee->name }}</td>
                                    <td class="py-4 px-6">{{ $employee->email }}</td>
                                    <td class="py-4 px-6">{{ $employee->phone }}</td>
                                    <td class="py-4 px-6">{{ $employee->type }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('employees.edit', $employee) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded shadow">
                                                Editar
                                            </a>
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded shadow"
                                                        onclick="return confirm('¿Estás seguro de eliminar este empleado?');">
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
                    {{ $employees->links() }}
                </div>

                <!-- Mensaje si no hay empleados -->
                @if ($employees->isEmpty())
                    <div class="text-center text-gray-500 dark:text-gray-400 py-6">
                        No hay empleados registrados.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
