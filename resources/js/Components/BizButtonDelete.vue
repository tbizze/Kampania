<script setup>
import { TrashIcon } from "@heroicons/vue/solid";
const props = defineProps({
  label: {
    type: [String],
    default: "",
  },
});

</script>

<template>
  <!-- Botão/Ícone para Deletar -->
  <button class="btn btn-accent btn-square rounded-md btn-xs">
    <component :is="TrashIcon" class="h-4 w-4" />
  </button>
</template>