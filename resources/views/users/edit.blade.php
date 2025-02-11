<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-2">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">

                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4">
                    Editar Información del Usuario
                </h3>

                <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- DNI -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">DNI</label>
                            <input type="text" name="dni" value="{{ old('dni', $user->dni) }}"
                                class="w-full border @error('dni') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('dni')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full border @error('name') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full border @error('email') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Teléfono</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full border @error('phone') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Dirección</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                class="w-full border @error('address') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha de Contratación -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Fecha de Contratación</label>
                            <input type="date" name="hire_date"
                                value="{{ old('hire_date', $user->hire_date ? \Carbon\Carbon::parse($user->hire_date)->format('Y-m-d') : '') }}"
                                class="w-full border @error('hire_date') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                            @error('hire_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Rol -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Rol</label>
                            <select name="role"
                                class="w-full border @error('role') border-red-500 @else border-gray-300 @enderror dark:border-gray-600 rounded-lg shadow-sm px-4 py-2 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                                @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
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
                        <a href="{{ route('users.index', ['page' => request('page', 1)]) }}"
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
</x-app-layout>