<script setup>
import {inject} from "vue";

const props = defineProps({
  id: String,
  modelValue: [Array, Boolean],
  required: Boolean,
  invalid: Boolean,
  ariaDescribedBy: String,
});

const emit = defineEmits(["update:modelValue"]);

const field = inject("field", props);
</script>
<template>
  <input
  :id="field.id"
    :value="props.modelValue"
    @input="$event => emit('update:modelValue', $event.target.value)"
    :required="field.required"
    :class="[
      'w-5 h-5 py-1 rounded bg-gray-100 hover:bg-gray-200 hover:border-gray-400 focus:ring-3 focus:ring-blue-300',
      field.invalid ? 'border-red-500' : 'border-gray-300',
    ]"
  />
</template>
