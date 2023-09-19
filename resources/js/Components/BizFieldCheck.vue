<script setup>
import Label from "@/components/BizLabel.vue";
import ErrorMessage from "@/components/BizErrorMessage.vue";
import HelperMessage from "@/components/BizHelperMessage.vue";
import {v4 as uuid} from "uuid";
import {computed, provide} from "vue";

const props = defineProps({
  id: {
    type: String,
    default: () => `field-${uuid()}`,
  },
  label: String,
  required: Boolean,
  error: String,
  help: String,
});

const ariaDescribedBy = computed(() => {
  return !!props.help ? `help-${uuid()}` : null;
});

provide(
  "field",
  computed(() => {
    return {
      ...props,
      invalid: !!props.error,
      ariaDescribedBy: ariaDescribedBy.value,
    };
  })
);
</script>

<template>
  <div class="flex gap-1 items-center py-1">
    
    <slot v-bind="props" />

    <Label
      v-if="props.label"
      :for="props.id"
      :required="props.required"
      >{{ props.label }}</Label
    >
</div>
<div>
    <ErrorMessage v-if="props.error">
      {{ props.error }}
    </ErrorMessage>

    <HelperMessage
      class="mt-1 ml-1 text-sm text-gray-400 dark:text-gray-400"
      v-if="props.help"
      :id="ariaDescribedBy"
    >
      {{ props.help }}
    </HelperMessage>
  </div>
</template>