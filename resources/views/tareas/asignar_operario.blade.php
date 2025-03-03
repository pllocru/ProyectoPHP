<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asignar Operario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">Asignar Operario a la Tarea</h3>

            <form action="{{ route('tareas.guardarOperario', $tarea) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="usuario_id" class="block font-semibold text-white">Operario:</label>
                    <select name="usuario_id" id="usuario_id" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled selected>Seleccione un operario</option>
                        @foreach ($operarios as $operario)
                            <option value="{{ $operario->id }}">{{ $operario->name }}</option>
                        @endforeach
                    </select>
                    @error('usuario_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition">
                    Asignar Operario
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
