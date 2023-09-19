<script setup>
import { PencilIcon } from "@heroicons/vue/solid";
const props = defineProps({
  label: {
    type: [String],
    default: "",
  },
});

</script>

<template>
  <!-- Botão/Ícone para Editar -->
  <button class="btn btn-secondary btn-square rounded-md btn-xs">
    <component :is="PencilIcon" class="h-4 w-4" />
  </button>
</template>