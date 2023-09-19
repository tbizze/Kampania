<script setup>
import { PlusIcon } from "@heroicons/vue/solid";
const props = defineProps({
  label: {
    type: [String],
    default: "",
  },
});

</script>

<template>
  <!-- Botão/Ícone para Editar -->
  <button class="btn btn-primary gap-2">
    {{ props.label }}
    <component :is="PlusIcon" class="h-4 w-4" />
  </button>
</template>