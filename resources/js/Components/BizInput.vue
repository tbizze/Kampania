<script setup>
import {inject} from "vue";

const props = defineProps({
  id: String,
  modelValue: [String, Number],
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
      'py-1 w-full rounded-md bg-gray-100 hover:bg-gray-200 hover:border-gray-400 focus:border-blue-500 focus:ring-blue-500',
      field.invalid ? 'border-red-500' : 'border-gray-300',
    ]"
  />
</template>