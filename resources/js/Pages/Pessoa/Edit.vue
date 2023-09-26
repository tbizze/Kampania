<script setup>
import { router, useForm, Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

import BaseListbox from "@/Components/BizListBox.vue";
import BizInput from "@/Components/BizInput.vue";
import BizField from "@/Components/BizField.vue";
import BizButtonSave from "@/Components/BizButtonSave.vue";
import BizButtonCancel from "@/Components/BizButtonCancel.vue";

const props = defineProps({
  titulo: "",
  registro: Object,
  list_est_civil: Object,
  list_sexos: Object,
  camp_gpos: Object,
  camp_sits: Object,
});

const form = useForm({
  codigo: props.registro.codigo,
  nome: props.registro.nome,
  sexo: props.registro.sexo,
  dt_nasc: props.registro.dt_nasc,
  dt_casamento: props.registro.dt_casamento,
  conjuge: props.registro.conjuge,
  profissao: props.registro.profissao,
  rg_ie: props.registro.rg_ie,
  cpf_cnpj: props.registro.cpf_cnpj,
  email: props.registro.email,
  celular: props.registro.celular,
  notas: props.registro.notas,
  pess_est_civil_id: props.registro.pess_est_civil_id,
  //lcto_grupo_id: props.registro.lcto_grupo_id,
  id: props.registro.id,
});

/** 
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("pessoas.update", props.registro.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("pessoas.index"));
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
            <!-- Campo Código -->
            <div class="md:w-1/5">
              <BizField id="codigo" label="Código" :error="form.errors.codigo">
                <BizInput v-model="form.codigo" placeholder="Digite um código" type="text" />
              </BizField>
            </div>

            <!-- Campo Nome -->
            <div class="md:w-4/5">
              <BizField id="nome" label="Nome" :error="form.errors.nome">
                <BizInput v-model="form.nome" placeholder="Digite um nome" type="text" />
              </BizField>
            </div>
          </div>


          <div class="md:flex gap-2 mb-4">
            <!-- Campo Código -->
            <div class="md:w-1/5">
              <BizField id="celular" label="Celular" :error="form.errors.celular">
                <BizInput v-model="form.celular" placeholder="Digite um celular" type="text" />
              </BizField>
            </div>

            <!-- Campo Nome -->
            <div class="md:w-4/5">
              <BizField id="email" label="E-mail" :error="form.errors.email">
                <BizInput v-model="form.email" placeholder="Digite um e-mail" type="text" />
              </BizField>
            </div>
          </div>


          <div class="md:flex gap-2 mb-4">
            <!-- Campo Sexo -->
            <div class="md:w-1/4 ">
              <label class="mb-1 ml-1 inline-block text-sm text-gray-700">Sexo</label>
              <BaseListbox
                v-model="form.sexo"
                :options="list_sexos"
                class="w-full"
                :error="form.errors.sexo"
              />
            </div>
            <!-- Campo Estado Civil -->
            <div class="md:w-3/4">
              <label class="mb-1 ml-1 inline-block text-sm text-gray-700">Estado Civil</label>
              <BaseListbox
                v-model="form.pess_est_civil_id"
                :options="list_est_civil"
                class="w-full"
                :error="form.errors.pess_est_civil_id"
              />
            </div>
            <!-- Campo tipo -->
            <div class="md:w-3/4">
              <BizField id="dt_nasc" label="Data Nasc." :error="form.errors.dt_nasc">
                <BizInput v-model="form.dt_nasc" placeholder="Digite uma data" type="text" />
              </BizField>
            </div>
            <!-- Campo tipo -->
            <div class="md:w-3/4">
              <BizField id="dt_casamento" label="Data Casamento" :error="form.errors.dt_casamento">
                <BizInput v-model="form.dt_casamento" placeholder="Digite uma data" type="text" />
              </BizField>
            </div>
          </div>


          <div class="md:flex gap-2 mb-4">
            <!-- Campo Código -->
            <div class="md:w-1/5">
              <BizField id="profissao" label="Profissao" :error="form.errors.profissao">
                <BizInput v-model="form.profissao" placeholder="Digite uma profissão" type="text" />
              </BizField>
            </div>
            <!-- Campo Nome -->
            <div class="md:w-4/5">
              <BizField id="conjuge" label="Conjuge" :error="form.errors.conjuge">
                <BizInput v-model="form.conjuge" placeholder="Digite um conjuge" type="text" />
              </BizField>
            </div>
          </div>
          

          <div class="md:flex gap-2 mb-4">
            <!-- Campo Notas -->
            <div class="md:w-full">
              <BizField id="notas" label="Notas" :error="form.errors.notas">
                <BizInput v-model="form.notas" placeholder="Digite uma observação" type="text" />
              </BizField>
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