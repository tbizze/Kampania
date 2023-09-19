<script setup>
import { SwitchVerticalIcon } from "@heroicons/vue/solid";
import { SortAscendingIcon } from "@heroicons/vue/solid";
import { SortDescendingIcon } from "@heroicons/vue/solid";

const props = defineProps({
  field: {
    type: [String],
    default: null,
  },
  direction: {
    type: [String],
    default: null,
  },
  coluna: {
    type: [String],
    default: null,
  },
});

</script>

<template>
  <div class="inline-flex items-center gap-1">
    <span class="">
      <slot />
    </span>
    <!-- Se ASC -->
    <component v-if="props.field === props.coluna && props.direction === 'asc'" :is="SortAscendingIcon" class="h-4 w-4" />
    <!-- Se DESC -->
    <component v-else-if="props.field === props.coluna && props.direction === 'desc'" :is="SortDescendingIcon"
      class="h-4 w-4" />
    <!-- Se NENHUM -->
    <component v-if="props.field !== props.coluna" :is="SwitchVerticalIcon" class="h-4 w-4" />
  </div>
</template>