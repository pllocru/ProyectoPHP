<script setup>
const goToLogin = () => {
    window.location.href = "/login";
};

const goToCreateTask = () => {
    window.location.href = "/tareas/verificar";
};
</script>

<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-gray-800 to-gray-900 text-white p-6">
        <!-- Logo o Imagen representativa -->
        <img class="w-52 mb-8 rounded-xl shadow-2xl"
             src="https://images.unsplash.com/photo-1564078516393-cf04bd966897?auto=format&fit=crop&w=600&q=80"
             alt="SiempreColgados Ascensores" />

        <!-- Título -->
        <h1 class="text-5xl font-extrabold text-white text-center">
            Bienvenido a SiempreColgados 🏢
        </h1>

        <!-- Descripción -->
        <p class="mt-5 text-lg text-gray-300 text-center max-w-2xl">
            Nos complace presentarte nuestra nueva plataforma de gestión de incidencias,
            mejorada con la tecnología de <strong>Nosecaen S.L.</strong> para llevar nuestro mantenimiento de ascensores al siguiente nivel.
        </p>

        <!-- Botones -->
        <div class="mt-10 flex flex-col sm:flex-row gap-4">
            <button @click="goToLogin"
                class="px-8 py-3 bg-blue-700 text-white text-lg font-medium rounded-xl shadow-md hover:bg-blue-800 transition">
                Acceder a la Plataforma
            </button>

            <button @click="goToCreateTask"
                class="px-8 py-3 bg-emerald-600 text-white text-lg font-medium rounded-xl shadow-md hover:bg-emerald-700 transition">
                Reportar Incidencia
            </button>
        </div>

        <!-- Pie de página -->
        <footer class="mt-12 text-sm text-gray-500 text-center">
            © 2025 SiempreColgados S.L. Todos los derechos reservados.
        </footer>
    </div>
</template>
