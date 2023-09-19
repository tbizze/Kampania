<script setup>
import { Link } from "@inertiajs/vue3";
import { computed, useSlots } from 'vue';
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <!-- #### SEÇÃO: Corpo da Página -->
    <div class="pb-12">
      <div class="max-w-5xl mx-auto py-1 sm:px-6 lg:px-8">

        <!-- Abre uma quadro, c/ sobras... p/ o formulário: topo, corpo e rodapé -->
        <div class="bg-white overflow-hidden shadow-md  sm:rounded-lg">
          <div class="font-sans text-gray-900 antialiased">

              <div class="flex flex-col itens-center pt-5 ">
                
                <!-- INSERT: 
                     Cabeçalho do formulário -->
                <slot name="formHeader" />
                
                <!-- INSERT: 
                     Corpo do formulário -->
                <div class="mx-5">
                  <slot name="formBody" />
                </div>

                <!-- INSERT: 
                     Rodapé do formulário -->
                <div class="px-5 py-3 bg-gray-50">
                  <slot name="formFooter" />
                </div>

              </div>
          </div>
        </div>
      </div>
    </div>
</template>
