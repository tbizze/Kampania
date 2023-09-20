<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

import FormInput from "@/Components/FormInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Card from "@/Components/Card.vue";

import BizButtonSave from "../../Components/BizButtonSave.vue";
import BizButtonCancel from "../../Components/BizButtonCancel.vue";
import BizFieldCheck from "../../Components/BizFieldCheck.vue";
import BizInputCheck from "../../Components/BizInputCheck.vue";

const props = defineProps({
  role: Object,
  permissions: Object,
  role_permissions: Object,
  permissions_models: Object,
  titulo: "",
});

const form = useForm({
  permissions: props.role_permissions,
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("admin.roles.update", props.role.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("admin.roles"));
}
</script>
<template>
  <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
  <Head :title="$props.titulo" />
  <AppLayout :title="props.titulo">
    
    <!-- #### SEÇÃO: Título da Página -->
    <template #header>
      <h2 class="font-semibold text-3xl">
        {{ titulo }}
      </h2>
    </template>

    <SectionPageForm>

      <!-- SESSÃO: Corpo do Formulário -->
      <template #formBody>

          <!-- Dados Cabeçalho -->
          <div class="border-b">
            <!-- Campo Nome -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel value="Nome" class="font-bold md:text-right pr-4" />
              </div>

              <div class="md:w-5/6">{{ role.name }}</div>
            </div>

            <!-- Campo Notas -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  value="E-mail"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">{{ role.description }}</div>
            </div>
          </div>


          <!-- Formulário -->
          <form @submit.prevent="submit()" class="pt-5">
            
            <div class="md:flex mb-4">
              
              <!-- Rótulo -->
              <div class="md:w-1/6 md:text-right pr-2">
                <span class="font-bold">Permissões:</span>
              </div>

              <!-- CARD das permissões // por função -->
              <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                  v-for="permissions_model in permissions_models"
                  :key="permissions_model.model"
                  class="sm:p-3 md:p-5 border border-gray-200 rounded-lg shadow"
                >
                  <div class="text-xl font-medium text-gray-900 mb-1 py-1">
                    {{ permissions_model.model }}
                  </div>
                  <div
                    v-for="permission in permissions"
                    :key="permission.id"
                    class=""
                  >
                    <div
                      v-if="permission.model == permissions_model.model"
                      class="w-full text-sm flex items-center h-7"
                    >
                      <input
                      :id="'permission_'+permission.id"
                      type="checkbox"
                        v-model="form.permissions"
                        :value="permission.id"
                        class="w-5 h-5 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                      />
                      <label :for="'permission_'+permission.id" class="ml-2 text-gray-900">{{permission.description}}</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </form>
      </template>

      <!-- SESSÃO: Rodapé do Formulário -->
      <template #formFooter>
        <!-- BOTÕES -->
        <div class="md:flex gap-2">
          <BizButtonSave @click.prevent="submit" label="Salvar" />
          <BizButtonCancel @click.prevent="cancelSave" label="Cancelar" />
        </div>
      </template>

    </SectionPageForm>
  </AppLayout>
</template>