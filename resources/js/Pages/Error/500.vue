<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";

defineProps({
  title: {
    type: [String],
    default: "Não encontrado",
  },
});
</script>

<template>
  <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
  <Head :title="$props.title" />

  <div>
    <main
      aria-labelledby="pageTitle"
      class="flex items-center justify-center h-screen bg-gray-100 dark:bg-dark dark:text-light"
    >
      <div class="p-4 space-y-4">
        <div
          class="flex flex-col items-start space-y-3 sm:flex-row sm:space-y-0 sm:items-center sm:space-x-3"
        >
          <p class="font-semibold text-red-500 text-9xl dark:text-red-600">
            500
          </p>
          <div class="space-y-2">
            <h1 id="pageTitle" class="flex items-center space-x-2">
              <svg
                aria-hidden="true"
                class="w-6 h-6 text-red-500 dark:text-red-600"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                />
              </svg>
              <span
                class="text-xl font-medium text-gray-600 sm:text-2xl dark:text-light"
              >
                Oops! Falha no sistema.
              </span>
            </h1>
            <p class="text-gray-600 dark:text-gray-300">
              Houve uma inconsistência na aplicação.
            </p>
            <p class="text-gray-600 dark:text-gray-300">
              Retorne à página inicial e tente outra opção. Se desejar, informe o desenvolvedor.
            </p>
          </div>
        </div>
      </div>
    </main>

    <div class="fixed top-5 right-5">
      <Link
        :href="route('dashboard')"
        class="inline-block px-4 py-2 bg-red-500 text-white rounded-md shadow-sm transition-colors hover:bg-red-700 focus:outline-none focus:ring"
      >
        Dashboard
      </Link>
    </div>
  </div>
</template>

<style>
:root {
  --light: #edf2f9;
  --dark: #152e4d;
  --darker: #12263f;
}

.dark .dark\:text-light {
  color: var(--light);
}

.dark .dark\:bg-dark {
  background-color: var(--dark);
}

.dark .dark\:bg-darker {
  background-color: var(--darker);
}

.dark .dark\:text-gray-300 {
  color: #d1d5db;
}
</style>

