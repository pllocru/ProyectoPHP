<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Modificar Tarea</h3>

            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('tareas.update', $tarea->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Persona de Contacto -->
                <div>
                    <label for="persona_contacto" class="block font-semibold text-white">Persona de Contacto:</label>
                    <input type="text" name="persona_contacto" value="{{ old('persona_contacto', $tarea->persona_contacto) }}" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('persona_contacto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono de Contacto -->
                <div>
                    <label for="telefono_contacto" class="block font-semibold text-white">Teléfono de Contacto:</label>
                    <input type="text" name="telefono_contacto" value="{{ old('telefono_contacto', $tarea->telefono_contacto) }}" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('telefono_contacto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Correo de Contacto -->
                <div>
                    <label for="correo_contacto" class="block font-semibold text-white">Correo de Contacto:</label>
                    <input type="email" name="correo_contacto" value="{{ old('correo_contacto', $tarea->correo_contacto) }}" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('correo_contacto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dirección -->
                <div>
                    <label for="direccion" class="block font-semibold text-white">Dirección:</label>
                    <input type="text" name="direccion" value="{{ old('direccion', $tarea->direccion) }}" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('direccion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Población -->
                <div>
                    <label for="poblacion" class="block font-semibold text-white">Población:</label>
                    <input type="text" name="poblacion" value="{{ old('poblacion', $tarea->poblacion) }}" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('poblacion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código Postal -->
                <div>
                    <label for="codigo_postal" class="block font-semibold text-white">Código Postal:</label>
                    <input type="text" name="codigo_postal" value="{{ old('codigo_postal', $tarea->codigo_postal) }}" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('codigo_postal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Provincia -->
                <div>
                    <label for="provincia" class="block font-semibold text-white">Provincia:</label>
                    <select name="provincia" id="provincia" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled {{ old('provincia', $tarea->provincia) ? '' : 'selected' }}>Seleccione una provincia</option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->cod }}" {{ old('provincia', $tarea->provincia) == $provincia->cod ? 'selected' : '' }}>
                                {{ $provincia->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('provincia')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="descripcion" class="block font-semibold text-white">Descripción:</label>
                    <textarea name="descripcion" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="estado" class="block font-semibold text-white">Estado:</label>
                    <select name="estado" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="N" {{ old('estado', $tarea->estado) == 'N' ? 'selected' : '' }}>Asignar Operario</option>
                        <option value="P" {{ old('estado', $tarea->estado) == 'P' ? 'selected' : '' }}>Pendiente</option>
                        <option value="R" {{ old('estado', $tarea->estado) == 'R' ? 'selected' : '' }}>En Progreso</option>
                        <option value="C" {{ old('estado', $tarea->estado) == 'C' ? 'selected' : '' }}>Completado</option>
                    </select>
                    @error('estado')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón Guardar -->
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition">
                    Guardar Cambios
                </button>

            </form>
        </div>
    </div>
</x-app-layout>
