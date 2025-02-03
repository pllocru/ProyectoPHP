<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Empleado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Editar Información del Empleado</h3>

                <form action="{{ route('employees.update', $employee) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">DNI</label>
                            <input type="text" name="dni" value="{{ old('dni', $employee->dni) }}"
                                   class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $employee->name) }}"
                                   class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" value="{{ old('email', $employee->email) }}"
                                   class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Teléfono</label>
                            <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}"
                                   class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-gray-700 dark:text-gray-300">Tipo</label>
                            <select name="type" class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white">
                                <option value="Admin" {{ old('type', $employee->type) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Empleado" {{ old('type', $employee->type) == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow mr-2">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                            Guardar Cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
