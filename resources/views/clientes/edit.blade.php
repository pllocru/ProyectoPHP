<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-2">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">

                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                    Editar Información del Cliente
                </h3>

                <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- CIF -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">CIF</label>
                            <input type="text" name="cif" value="{{ old('cif', $cliente->cif) }}"
                                class="w-full border @error('cif') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('cif')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}"
                                class="w-full border @error('nombre') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('nombre')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                                class="w-full border @error('telefono') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('telefono')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Correo -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Correo Electrónico</label>
                            <input type="email" name="correo" value="{{ old('correo', $cliente->correo) }}"
                                class="w-full border @error('correo') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('correo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cuenta Corriente -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Cuenta Corriente</label>
                            <input type="text" name="cuenta_corriente"
                                value="{{ old('cuenta_corriente', $cliente->cuenta_corriente) }}"
                                class="w-full border @error('cuenta_corriente') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('cuenta_corriente')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- País -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">País</label>
                            <select name="pais_id" id="pais_id"
                                class="w-full border @error('pais_id') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}" data-moneda="{{ $pais->iso_moneda }}" {{ old('pais_id', $cliente->pais_id) == $pais->id ? 'selected' : '' }}>
                                        {{ $pais->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pais_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Moneda -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Moneda</label>
                            <input type="text" id="moneda" name="moneda" value="{{ old('moneda', $cliente->moneda) }}" readonly
                                class="w-full border @error('moneda') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 cursor-not-allowed">
                            @error('moneda')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Importe de Cuota Mensual -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Importe Cuota Mensual (€)</label>
                            <input type="number" step="0.01" name="importe_cuota_mensual"
                                value="{{ old('importe_cuota_mensual', $cliente->importe_cuota_mensual) }}"
                                class="w-full border @error('importe_cuota_mensual') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('importe_cuota_mensual')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('clientes.index', ['page' => request('page', 1)]) }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Guardar Cambios
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('pais_id').addEventListener('change', function() {
            var moneda = this.options[this.selectedIndex].getAttribute('data-moneda');
            document.getElementById('moneda').value = moneda ? moneda : 'NULL';
        });

        // Trigger change event on page load to set the initial value of the moneda field
        document.getElementById('pais_id').dispatchEvent(new Event('change'));
    </script>
</x-app-layout>
