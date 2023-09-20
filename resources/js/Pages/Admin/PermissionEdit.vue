<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

import BizInput from "@/components/BizInput.vue";
import BizField from "@/components/BizField.vue";
import BizButtonSave from "../../Components/BizButtonSave.vue";
import BizButtonCancel from "../../Components/BizButtonCancel.vue";

const props = defineProps({
  permission: Object,
  titulo: "",
  roles: Object,
  permission_roles: Object,
});

const form = useForm({
  name: props.permission.name,
  description: props.permission.description,
  model: props.permission.model,
  id: props.permission.id,
  permission_roles: props.permission_roles,
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("admin.permissions.update", props.permission.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("admin.permissions"));
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


    <!-- SESSÃO: Corpo do Formulário -->
    <SectionPageForm>
      <template #formBody>
          <form @submit.prevent="submit()">

            <div class="md:flex gap-2 mb-4">
              <!-- Campo Nome -->
              <div class="md:w-1/2">
                <BizField id="nome" label="Nome" :error="form.errors.name">
                  <BizInput v-model="form.name" placeholder="Registre um nome" type="text" />
                </BizField>
              </div>

              <!-- Campo Notas -->
              <div class="md:w-1/2">
                <BizField id="notas" label="Modelo" :error="form.errors.model">
                  <BizInput v-model="form.model" placeholder="Registre um modelo" type="text" />
                </BizField>
              </div>
            </div>
            <div class="md:flex gap-2 mb-4">
              <!-- Campo Notas -->
              <div class="md:w-full">
                <BizField id="notas" label="Descrição" :error="form.errors.description">
                  <BizInput v-model="form.description" placeholder="Registre uma descrição" type="text" />
                </BizField>
              </div>
            </div>


            <!-- Linha divisora -->
            <div class="border-b mb-4"></div>

            <!-- Lista com as funções -->
            <div class="md:flex gap-2 mb-6">
              <!-- Label -->
              <span class="pr-1 text-right text-sm w-1/5">Atribuição de Funções:</span>
              <!-- Checkbox com as funções -->
              <div class="md:w-4/5 flex gap-2 items-center">
                <div v-for="role in roles" :key="role.id">
                  
                  <input :id="'role_'+role.id" type="checkbox" 
                    v-model="form.permission_roles" :value="role.id"
                    class="w-5 h-5 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                  <label :for="'role_'+role.id" class="pl-1.5 text-sm">{{ role.name }}</label>
                </div>
              </div>
            </div>
          </form>

      </template>
      
      <!-- SESSÃO: Rodapé do Formulário -->
      <template #formFooter>
        <!-- BOTÕES -->
        <div class="md:flex gap-2">
          <!-- <button class="btn btn-sm btn-primary" @click.prevent="submit">Salvar</button> -->
          <BizButtonSave @click.prevent="submit" label="Salvar" />
          <BizButtonCancel @click.prevent="cancelSave" label="Cancelar" />
          <!-- <button class="btn btn-sm btn-secondary" @click.prevent="cancelSave">Cancelar</button> -->
        </div>
      </template>
    </SectionPageForm>
  </AppLayout>
</template>