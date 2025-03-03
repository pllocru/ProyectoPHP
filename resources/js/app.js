import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import Alpine from 'alpinejs';
import '../css/app.css';

// Iniciar Alpine.js
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const appElement = document.getElementById('app');

    if (!appElement) {
        console.warn("⚠️ Advertencia: No se encontró #app en el DOM. Evitando error.");
        return;
    }

    console.log("✅ #app encontrado, iniciando Inertia...");

    createInertiaApp({
        resolve: (name) =>
            resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ el, App, props, plugin }) {
            console.log("🚀 Montando Vue en:", el);
            createApp({ render: () => h(App, props) })
                .use(plugin)
                .mount(el);
        },
    });
});
