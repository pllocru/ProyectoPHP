<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="text-4xl font-extrabold text-center mb-4 text-white">
            Accede a SiempreColgados 🔐
        </h1>


        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Divider -->
        <div class="my-6 flex items-center justify-center">
            <div class="border-t border-gray-300 w-full"></div>
            <span class="mx-4 text-gray-500">O</span>
            <div class="border-t border-gray-300 w-full"></div>
        </div>

        <!-- Botón de Google -->
        <div class="flex justify-center">
            <a href="{{ route('google.redirect') }}"
                class="flex items-center gap-2 px-6 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition">
                <!-- Logo de Google -->
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.5581 12.2311C22.5581 11.4601 22.4891 10.7211 22.3611 10.0011H12.1831V14.2841H18.0891C17.8251 15.6901 17.0541 16.8661 15.9121 17.6431V20.1851H19.5791C21.8121 18.1351 22.5581 15.4191 22.5581 12.2311Z"
                        fill="white" />
                    <path
                        d="M12.1831 22.0001C15.1481 22.0001 17.5751 21.0161 19.5791 19.3951L15.9121 16.8531C14.8631 17.5831 13.5981 17.9971 12.1831 17.9971C9.31207 17.9971 6.91807 16.0351 6.03707 13.4041H2.24407V16.0361C4.27307 19.6291 7.96407 22.0001 12.1831 22.0001Z"
                        fill="white" />
                    <path
                        d="M6.03691 13.403C5.63691 12.161 5.63691 10.838 6.03691 9.59603V6.96303H2.24491C0.798908 9.71603 0.798908 13.283 2.24491 16.036L6.03691 13.403Z"
                        fill="white" />
                    <path
                        d="M12.1831 5.99705C13.7191 5.97305 15.2111 6.53405 16.3161 7.58105L19.6561 4.24105C17.4731 2.20605 14.7051 1.15705 12.1831 1.18305C7.96407 1.18305 4.27307 3.55405 2.24407 7.14705L6.03707 9.78005C6.91807 7.14905 9.31207 5.18805 12.1831 5.99705Z"
                        fill="white" />
                </svg>
                <span class="text-white">Iniciar sesión con Google</span>
            </a>
        </div>

    </form>
</x-guest-layout>