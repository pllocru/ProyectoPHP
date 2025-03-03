<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir Nueva Tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Nueva Tarea</h3>

            <form action="{{ route('tareas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Cliente -->
                <div>
                    <label for="cliente_id"
                        class="block font-semibold text-gray-700 dark:text-gray-300">Cliente:</label>
                    <select name="cliente_id" id="cliente_id" required
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled {{ old('cliente_id') ? '' : 'selected' }}>Seleccione un cliente
                        </option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Operario -->
                <div>
                    <label for="usuario_id"
                        class="block font-semibold text-gray-700 dark:text-gray-300">Operario:</label>
                    <select name="usuario_id" id="usuario_id" required
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled {{ old('usuario_id') ? '' : 'selected' }}>Seleccione un operario
                        </option>
                        @foreach ($operarios as $operario)
                            <option value="{{ $operario->id }}" {{ old('usuario_id') == $operario->id ? 'selected' : '' }}>
                                {{ $operario->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('usuario_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Persona de Contacto -->
                <div>
                    <label for="persona_contacto" class="block font-semibold text-gray-700 dark:text-gray-300">Persona
                        de Contacto:</label>
                    <input type="text" name="persona_contacto" id="persona_contacto"
                        value="{{ old('persona_contacto') }}"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('persona_contacto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono de Contacto -->
                <div>
                    <label for="telefono_contacto" class="block font-semibold text-gray-700 dark:text-gray-300">Teléfono
                        de Contacto:</label>
                    <input type="text" name="telefono_contacto" id="telefono_contacto"
                        value="{{ old('telefono_contacto') }}"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('telefono_contacto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Correo de Contacto -->
                <div>
                    <label for="correo_contacto" class="block font-semibold text-gray-700 dark:text-gray-300">Correo de
                        Contacto:</label>
                    <input type="email" name="correo_contacto" id="correo_contacto" value="{{ old('correo_contacto') }}"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('correo_contacto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dirección -->
                <div>
                    <label for="direccion"
                        class="block font-semibold text-gray-700 dark:text-gray-300">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('direccion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Población -->
                <div>
                    <label for="poblacion"
                        class="block font-semibold text-gray-700 dark:text-gray-300">Población:</label>
                    <input type="text" name="poblacion" id="poblacion" value="{{ old('poblacion') }}"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('poblacion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código Postal -->
                <div>
                    <label for="codigo_postal" class="block font-semibold text-gray-700 dark:text-gray-300">Código
                        Postal:</label>
                    <input type="text" name="codigo_postal" id="codigo_postal" value="{{ old('codigo_postal') }}"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('codigo_postal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Provincia -->
                <div>
                    <label for="provincia"
                        class="block font-semibold text-gray-700 dark:text-gray-300">Provincia:</label>
                    <select name="provincia" id="provincia" required
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled {{ old('provincia') ? '' : 'selected' }}>Seleccione una provincia
                        </option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->cod }}" {{ old('provincia') == $provincia->cod ? 'selected' : '' }}>
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
                    <label for="descripcion"
                        class="block font-semibold text-gray-700 dark:text-gray-300">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" required
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="estado" class="block font-semibold text-gray-700 dark:text-gray-300">Estado:</label>
                    <select name="estado" id="estado"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="P" {{ old('estado') == 'P' ? 'selected' : '' }}>Pendiente</option>
                        <option value="R" {{ old('estado') == 'R' ? 'selected' : '' }}>En Progreso</option>
                        <option value="C" {{ old('estado') == 'C' ? 'selected' : '' }}>Completado</option>
                    </select>
                </div>

                <!-- Fecha de Creación -->
                <div>
                    <label for="fecha_creacion" class="block font-semibold text-gray-700 dark:text-gray-300">Fecha de
                        Creación:</label>
                    <input type="date" name="fecha_creacion" id="fecha_creacion" value="{{ old('fecha_creacion') }}"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('fecha_creacion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Anotaciones Anteriores -->
                <div>
                    <label for="anotaciones_anteriores"
                        class="block font-semibold text-gray-700 dark:text-gray-300">Anotaciones Anteriores:</label>
                    <textarea name="anotaciones_anteriores" id="anotaciones_anteriores"
                        class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('anotaciones_anteriores') }}</textarea>
                    @error('anotaciones_anteriores')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón Guardar -->
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition">
                    Guardar Tarea
                </button>

            </form>
        </div>
    </div>
</x-app-layout>