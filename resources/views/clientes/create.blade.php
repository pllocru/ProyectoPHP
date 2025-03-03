<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                    Editar Información del Cliente
                </h3>
                <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">CIF</label>
                            <input type="text" name="cif" value="{{ old('cif', '') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('cif')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">name</label>
                            <input type="text" name="name" value="{{ old('name', '') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', '') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('telefono')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Correo
                                Electrónico</label>
                            <input type="email" name="email" value="{{ old('email', '') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Cuenta
                                Corriente</label>
                            <input type="text" name="cuenta_corriente" value="{{ old('cuenta_corriente', '') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('cuenta_corriente')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">País</label>
                            <select name="pais_id" id="pais_id" required
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>Seleccione un país</option>
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}" data-moneda="{{ $pais->iso_moneda }}" {{ old('pais_id', '') == $pais->id ? 'selected' : '' }}>
                                        {{ $pais->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pais_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Moneda</label>
                            <input type="text" id="moneda" name="moneda" value="{{ old('moneda', '') }}" readonly
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Importe Cuota
                                Mensual</label>
                            <input type="number" step="0.01" name="importe_cuota_mensual"
                                value="{{ old('importe_cuota_mensual', '') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('importe_cuota_mensual')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('clientes.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">Cancelar</a>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">Guardar
                            Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('pais_id').addEventListener('change', function () {
            var moneda = this.options[this.selectedIndex].getAttribute('data-moneda');
            document.getElementById('moneda').value = moneda ? moneda : '';
        });
    </script>
</x-app-layout>