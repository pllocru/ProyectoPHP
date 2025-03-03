<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Cuota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                    Editar Información de la Cuota
                </h3>
                <form action="{{ route('cuotas.update', $cuota->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Cliente</label>
                            <select name="cliente_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 @error('cliente_id') border-red-500 @enderror">
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ $cuota->cliente_id == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Concepto</label>
                            <input type="text" name="concepto" value="{{ old('concepto', $cuota->concepto) }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 @error('concepto') border-red-500 @enderror">
                            @error('concepto')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Fecha de Emisión</label>
                            <input type="date" name="fecha_emision" value="{{ old('fecha_emision', $cuota->fecha_emision->format('Y-m-d')) }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 @error('fecha_emision') border-red-500 @enderror">
                            @error('fecha_emision')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Importe (EUR)</label>
                            <input type="text" name="importe" value="{{ old('importe', $cuota->importe) }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 @error('importe') border-red-500 @enderror">
                            @error('importe')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="hidden" name="moneda" value="EUR">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Pagada</label>
                            <select name="pagada" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 @error('pagada') border-red-500 @enderror">
                                <option value="0" {{ !$cuota->pagada ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $cuota->pagada ? 'selected' : '' }}>Sí</option>
                            </select>
                            @error('pagada')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Notas</label>
                            <textarea name="notas" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 @error('notas') border-red-500 @enderror">{{ old('notas', $cuota->notas) }}</textarea>
                            @error('notas')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('cuotas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">Cancelar</a>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>