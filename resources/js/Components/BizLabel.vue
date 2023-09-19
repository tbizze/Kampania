<script setup>
const props = defineProps({
  for: String,
  required: Boolean,
});
</script>
<template>
  <label
    class="mb-1 ml-1 inline-block text-sm text-gray-700"
    :for="props.for"
  >
    <slot /><span
      class="text-red-600"
      v-if="props.required"
      >*</span
    >
  </label>
</template>