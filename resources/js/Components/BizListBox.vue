<script setup>
import { computed } from "vue";
import {
  Listbox,
  ListboxButton,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";

const props = defineProps({
  options: Array,
  modelValue: [String, Number, Array],
  placeholder: {
    type: String,
    default: "Selecione...",
  },
  multiple: Boolean,
  error: String,
});

const emit = defineEmits(["update:modelValue"]);

const label = computed(() => {
  return props.options
    .filter((option) => {
      if (Array.isArray(props.modelValue)) {
        return props.modelValue.includes(option.value);
      }
      return props.modelValue === option.value;
    })
    .map((option) => option.label)
    .join(", ");
});
</script>
<template>
  <Listbox
    :model-value="props.modelValue"
    :multiple="props.multiple"
    @update:modelValue="(value) => emit('update:modelValue', value)"
  >
    <div class="relative ">
      <ListboxButton
        class="relative py-2 pr-10 pl-2 w-full text-left rounded-md border-gray-800 bg-gray-100 hover:bg-gray-200 hover:border-gray-400 focus:border-blue-500 focus:ring-blue-500"
      >
        <span v-if="label" class="block truncate">{{ label }}</span>
        <span v-else class="text-gray-500">{{ props.placeholder }}</span>
        <span
          class="flex absolute inset-y-0 right-0 items-center pr-2 pointer-events-none"
        >
          <SelectorIcon
            aria-hidden="true"
            class="w-5 h-5 text-gray-400 "
          />
        </span>
      </ListboxButton>

      <transition
        leave-active-class="transition duration-100 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <ListboxOptions
          class="overflow-auto absolute z-80 py-0 mt-1 w-full max-h-60 text-base bg-white rounded-md ring-1 ring-black ring-opacity-5 shadow-lg focus:outline-none sm:text-sm"
        >
        <!-- Opção padrão: valor nulo -->
        <ListboxOption
            v-slot="{ active, selected }"
            as="template"
          >
            <li
              :class="[
                active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                'relative cursor-default select-none py-1 pl-7 pr-4',
              ]"
            >
              <span
                :class="[
                  selected ? 'font-medium' : 'font-normal',
                  'block truncate italic',
                ]"
                >Selecione...</span
              >
              <span
                v-if="selected"
                class="flex absolute inset-y-0 left-0 items-center pl-1 text-amber-600"
              >
                <CheckIcon aria-hidden="true" class="w-5 h-5" />
              </span>
            </li>
          </ListboxOption>

          <!-- Opções recebidas de forma reativa -->
          <ListboxOption
            v-for="option in props.options"
            :key="option.label"
            v-slot="{ active, selected }"
            :value="option.value"
            as="template"
          >
            <li
              :class="[
                active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                'relative cursor-default select-none py-1 pl-7 pr-4',
              ]"
            >
              <span
                :class="[
                  selected ? 'font-medium' : 'font-normal',
                  'block truncate',
                ]"
                >{{ option.label }}</span
              >
              <span
                v-if="selected"
                class="flex absolute inset-y-0 left-0 items-center pl-1 text-amber-600"
              >
                <CheckIcon aria-hidden="true" class="w-5 h-5" />
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
      <div class="text-xs text-red-400 mt-1" v-if="props.error">
        {{ props.error }}
      </div>
    </div>
  </Listbox>
</template>