<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Tarea</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-4">Crear Nueva Tarea</h1>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('tareas.storenueva') }}" method="POST" class="space-y-4 mt-6">
            @csrf

            <!-- Persona de Contacto -->
            <div>
                <label for="persona_contacto" class="block font-semibold">Persona de Contacto:</label>
                <input type="text" name="persona_contacto" value="{{ old('persona_contacto') }}" required
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('persona_contacto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Teléfono de Contacto -->
            <div>
                <label for="telefono_contacto" class="block font-semibold">Teléfono de Contacto:</label>
                <input type="text" name="telefono_contacto" value="{{ old('telefono_contacto') }}" required
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('telefono_contacto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Correo de Contacto -->
            <div>
                <label for="correo_contacto" class="block font-semibold">Correo de Contacto:</label>
                <input type="email" name="correo_contacto" value="{{ old('correo_contacto') }}" required
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('correo_contacto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dirección -->
            <div>
                <label for="direccion" class="block font-semibold">Dirección:</label>
                <input type="text" name="direccion" value="{{ old('direccion') }}" required
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('direccion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Población -->
            <div>
                <label for="poblacion" class="block font-semibold">Población:</label>
                <input type="text" name="poblacion" value="{{ old('poblacion') }}" required
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('poblacion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Código Postal -->
            <div>
                <label for="codigo_postal" class="block font-semibold">Código Postal:</label>
                <input type="text" name="codigo_postal" value="{{ old('codigo_postal') }}" required
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('codigo_postal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Provincia -->
            <div>
                <label for="provincia" class="block font-semibold">Provincia:</label>
                <select name="provincia" id="provincia" required
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="" disabled {{ old('provincia') ? '' : 'selected' }}>Seleccione una provincia</option>
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
                <label for="descripcion" class="block font-semibold">Descripción:</label>
                <textarea name="descripcion" required
                    class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Estado oculto -->
            <input type="hidden" name="estado" value="N">

            <!-- Info Estado -->
            <div class="text-sm text-gray-400">
                Estado inicial: <span class="font-semibold text-white">Asignar Operario</span>
            </div>

            <!-- Botón Guardar -->
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition">
                Crear Tarea
            </button>

        </form>
    </div>

</body>

</html>