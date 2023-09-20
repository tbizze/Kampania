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

const props = defineProps({
  user: Object,
  roles: Object,
  user_roles: Object,
  titulo: "",
});

const form = useForm({
  user_roles: props.user_roles,
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("admin.users.update", props.user.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("admin.users"));
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
      <template #formBody>
        <div class="m-5">
          <!-- #### START #### -->
          <!-- Conteúdo da Página -->

          <!-- Dados Cabeçalho -->
          <div class="">
            <!-- Campo Nome -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel value="Nome" class="font-bold md:text-right pr-4" />
              </div>

              <div class="md:w-5/6">{{ user.name }}</div>
            </div>

            <!-- Campo Notas -->
            <div class="md:flex md:items-center mb-4">
              <div class="md:w-1/6">
                <InputLabel
                  value="E-mail"
                  class="font-bold md:text-right pr-4"
                />
              </div>

              <div class="md:w-5/6">{{ user.email }}</div>
            </div>
          </div>

          <!-- Formulário -->
          <form @submit.prevent="submit()" class="pt-5">
            

            <!-- Linha divisora -->
            <div class="border-b mb-4"></div>
            
            <!-- Lista com as funções -->
            <div class="md:flex gap-2 mb-6">
              <!-- Label -->
              <span class="pr-1 text-right text-sm">Atribuição de Funções:</span>
              <!-- Checkbox com as funções -->
              <div class="md:w-full flex gap-2 items-center">
                <div v-for="role in roles" :key="role.id">
                  <input :id="'role_'+role.id" type="checkbox" 
                    v-model="form.user_roles" :value="role.id" 
                    class="w-5 h-5 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                  <label :for="'role_'+role.id" class="pl-1.5 text-sm">{{ role.name }}</label>
                </div>
              </div>
            </div>

            <!-- BOTÕES -->
            <div class="md:flex gap-2 justify-end">
              <button class="btn btn-sm btn-primary">Salvar</button>
              <button
                class="btn btn-sm btn-secondary"
                @click.prevent="cancelSave"
              >
                Cancelar
              </button>
            </div>
          </form>

          <!-- #### END #### -->
          <!-- Conteúdo da Página -->
        </div>
      </template>
    </SectionPageForm>
  </AppLayout>
</template>