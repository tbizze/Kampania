<script setup>
import { Link } from "@inertiajs/vue3";
import { computed, useSlots } from "vue";

defineEmits(["submitted"]);

// Checa quais slots foram definidos, retornando true para eles. Assim posso usar condições para carregar.
const slots = useSlots();

const hasActions = computed(() => !!useSlots().actions);

</script>

<template>
  <!-- #### SEÇÃO: Corpo da Página -->
  <div class="pb-12">
    <div class="max-w-7xl mx-auto py-1 sm:px-6 lg:px-8">

      <!-- Abre uma quadro, p/ o cabeçalho: botões, filtros, etc -->
      <!-- <div v-if="slots.tabHeader" class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-4"> -->
      <div v-if="slots.tabHeader" class="bg-white overflow-visible shadow-md sm:rounded-lg mb-4">
        <!-- INSERT: 
             Filtros... -->
        <div class="flex px-2 py-2 space-x-3 bg">
          <slot name="tabHeader" />
        </div>
      </div>

      <!-- Abre uma quadro, c/ sobras... p/ o a tabela: rótulos, conteúdo, e rodapé da tabela -->
      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="flex flex-col itens-center pt-6 sm:pt-0">
          <!-- INSERT: 
                Cabeçalho e Corpo da Tabela -->
          <slot name="tabBody" />

          <!-- INSERT: 
                Rodapé [Totais, Paginação... -->
          <div v-if="slots.tabFooter" class="flex items-center justify-between space-x-3 px-2 py-2">
            <slot name="tabFooter" />
          </div>
          <!-- #### END #### -->
          <!-- Conteúdo da Página -->
        </div>
      </div>
    </div>
  </div>
</template>
