<script setup>
import { StopIcon } from "@heroicons/vue/solid"
const props = defineProps({
  label: {
    type: [String],
    default: "",
  },
});

</script>

<template>
  <!-- Botão/Ícone para Editar -->
  <button class="btn btn-accent btn-square rounded-md btn-xs">
    <component :is="StopIcon" class="h-4 w-4" />
  </button>
</template>