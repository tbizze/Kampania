<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="bg-gray-200 
               border-gray-200 border
               hover:border-gray-400 hover:bg-gray-300
               focus:border-indigo-400 
               rounded 
               py-1 px-2"
               
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
