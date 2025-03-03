<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Realizar Tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">

            <h3 class="text-lg font-bold text-white mb-6">Completar Tarea</h3>

            <form action="{{ route('tareas.guardarRealizada', $tarea) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="fecha_realizacion" class="block font-semibold text-white">Fecha de Realización:</label>
                    <input type="date" name="fecha_realizacion" required
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white">
                    @error('fecha_realizacion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="anotaciones_posteriores" class="block font-semibold text-white">Anotaciones Posteriores:</label>
                    <textarea name="anotaciones_posteriores"
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white"></textarea>
                    @error('anotaciones_posteriores')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fichero_resumen" class="block font-semibold text-white">Fichero Resumen (PDF):</label>
                    <input type="file" name="fichero_resumen"
                        class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 text-white">
                    @error('fichero_resumen')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded">
                    Finalizar Tarea
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
