<script setup>
const goToLogin = () => {
    window.location.href = "/login"; // ✅ Funciona sin usar `route()`
};
</script>

<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <h1 class="text-3xl font-bold text-blue-600">Bienvenido 🚀</h1>

        <button 
            @click="goToLogin"
            class="mt-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 transition"
        >
            Ir al Login
        </button>
    </div>
</template>
