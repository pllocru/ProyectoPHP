<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">

                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                    Información del Nuevo Usuario
                </h3>

                <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- DNI -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">DNI</label>
                            <input type="text" name="dni" value="{{ old('dni') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('dni') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Nombre</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('name') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('email') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Teléfono</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('phone') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Dirección</label>
                            <input type="text" name="address" value="{{ old('address') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('address') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Fecha de Contratación -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Fecha de Contratación</label>
                            <input type="date" name="hire_date" value="{{ old('hire_date') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('hire_date') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Contraseña</label>
                            <input type="password" name="password"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('password') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Rol -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Rol</label>
                            <select name="role"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                <option value="">Seleccione un rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('users.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Guardar Usuario
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
