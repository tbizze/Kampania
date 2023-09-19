<script setup>
const props = defineProps({
  label: {
    type: [String],
    default: "",
  },
});

</script>

<template>
  <!-- Botão/Ícone para Editar -->
  <button class="btn btn-sm btn-secondary">
    {{ props.label }}
  </button>
</template>