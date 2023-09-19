<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageTable from "@/Components/SectionPageTable.vue";
import Pagination from "@/Components/Pagination.vue";

import BizPageTitle from "../../Components/BizPageTitle.vue";
import ButtonCreate from "../../Components/BizButtonCreate.vue";
import ButtonEdit from "../../Components/BizButtonEdit.vue";
import ButtonDelete from "../../Components/BizButtonDelete.vue";
import ButtonStop from "../../Components/BizButtonStop.vue";
import ButtonPlay from "../../Components/BizButtonPlay.vue";
import BizTheadOrder from "../../Components/BizTheadOrder.vue";

import { SearchIcon,ArrowRightIcon } from "@heroicons/vue/solid";

const props = defineProps({
  users: Object,
  titulo: "",
  filters: Object,
});

const form = useForm({
  search: props.filters.search,
  field: props.filters.field,
  direction: props.filters.direction,
});

/**
 * Função para submeter o formulário de pesquisa.
 */
function submit() {
  router.get(route("admin.users"), form);
}

/**
 * Função para editar um registro.
 * Como parâmetro recebe o ID.
 */
function actionEdit(id) {
  router.get(route("admin.users.edit", id));
}
/**
 * Função para deletar um registro.
 * Como parâmetro recebe o ID.
 */
function actionDelete(id) {
  router.delete(route("admin.users.delete", id));
}
/**
 * Funções para Bloquear/Desbloquear um Usuário.
 * Como parâmetro recebe o ID.
 */
 function actionBan(id) {
  router.put(route("admin.users.ban", id));
}
function actionUnBan(id) {
  router.put(route("admin.users.unBan", id));
}
/**
 * Função para abrir formulário de cadastro.
 */
function actionAdd() {
  router.get(route("admin.users.create"));
}

/**
 * Função para realizar o OrderBy.
 */
function sort(field) {
  form.field = field;
  form.direction = form.direction === "asc" ? "desc" : "asc";
  submit();
}
</script>


<template>
  <!-- Carrega o Layout da Aplicação com "Logo e TopMenu, com botões Login/Logout..." -->
  <Head :title="$props.titulo" />
  <AppLayout :title="$props.titulo">
    <!-- #### SEÇÃO: Título da Página -->
    <template #header>
      <!-- Título -->
      <BizPageTitle>{{ $props.titulo }}</BizPageTitle>

      <!-- Botão Novo -->
      <ButtonCreate @click.prevent="actionAdd" label="Cadastrar"
        v-if="$page.props.auth.user.permissions.includes('admin.users.create')"/>
    </template>


    <!-- #### START: Conteúdo da Página #### -->
    <SectionPageTable>
      <!-- #### Header da Página -->
      <template #tabHeader>
        <div class="w-full md:w-1/2">
          <form @submit.prevent="submit()" class="flex gap-2">
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                <component :is="SearchIcon" class="h-5 w-5" />
              </div>
              <input type="search" v-model="form.search"
                class="py-1.5 text-sm rounded-md bg-gray-100 border-gray-300 hover:bg-gray-200 hover:border-gray-400 focus:border-blue-500 focus:ring-blue-500 pl-8"
                placeholder="Procurar" />
              
            </div>
            <!-- Botão/Ícone Pesquisar-->
            <button class="btn rounded-md btn-sm">
                <component :is="ArrowRightIcon" class="h-4 w-4" />
              </button>
          </form>
        </div>
      </template>

      

      <!-- #### Header e Body da Tabela -->
      <template #tabBody>
        <table class="table table-compact">
          <thead class="text-sm uppercase text-gray-700 bg-stone-200">
            <tr>
              <td class="text-center w-10">#</td>
              <td class="hover:text-accent cursor-pointer" @click="sort('name')">
                <BizTheadOrder :field="form.field" coluna="name" :direction="form.direction"
                
                >
                  Nome
                </BizTheadOrder>
              </td>
              <td class="hover:text-accent cursor-pointer" @click="sort('email')">
                <BizTheadOrder :field="form.field" coluna="email" :direction="form.direction">
                  E-mail
                </BizTheadOrder>
              </td>
              <td class="text-center">Funções</td>
              <td class="text-center">Ação</td>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="user in users.data"
              :key="user.id"
              class="border-b hover:bg-stone-100"
            >
              <td class="text-center w-10">{{ user.id }}</td>
              <td class="">{{ user.name }}</td>
              <td class="">{{ user.email }}</td>
              <td class="text-center space-x-1">
                <span
                  v-for="role in user.roles"
                  :key="role.id"
                  class="bg-base-300 px-1 py-0.5 text-sm rounded-lg"
                  >{{ role.name }}
                </span>
              </td>
              <td class="text-center space-x-1 w-32">
                <ButtonEdit @click.prevent="actionEdit(user.id)" 
                  v-if="$page.props.auth.user.permissions.includes('admin.users.edit')"/>
                <ButtonStop @click.prevent="actionBan(user.id)"
                  v-if="$page.props.auth.user.permissions.includes('admin.users.ban')"/>
                <ButtonPlay @click.prevent="actionUnBan(user.id)"
                  v-if="$page.props.auth.user.permissions.includes('admin.users.unban')"/>
                  <!-- <ButtonDelete @click.prevent="actionDelete(user.id)"
                  v-if="$page.props.auth.user.permissions.includes('admin.users.delete')"/> -->
              </td>
            </tr>
          </tbody>
        </table>
      </template>
      <!-- #### Footer da Tabela -->
      <template #tabFooter>
        
        <!-- Esquerda do Rodapé: Diversos -->
        <div class="font-semibold">
        </div>
        
        <!-- Direita do Rodapé: Paginação -->
        <Pagination :pagination="users" />

      </template>
    </SectionPageTable>
    <!-- #### END: Conteúdo da Página #### -->
  </AppLayout>
</template>