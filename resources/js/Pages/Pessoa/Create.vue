<script setup>
import { router, useForm, Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

import BaseListbox from "@/Components/BizListBox.vue";
import BizInput from "@/Components/BizInput.vue";
import BizField from "@/Components/BizField.vue";
import BizButtonSave from "@/Components/BizButtonSave.vue";
import BizButtonCancel from "@/Components/BizButtonCancel.vue";

import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";

import { vMaska } from "maska"

const props = defineProps({
  titulo: "",
  list_est_civil: Object,
  list_sexos: Object,
  camp_gpos: Object,
  camp_sits: Object,
});

const form = useForm({
  codigo: "",
  nome: "",
  sexo: "",
  dt_nasc: "",
  dt_casamento: "",
  conjuge: "",
  profissao: "",
  rg_ie: "",
  cpf_cnpj: "",
  email: "",
  celular: "",
  notas: "",
  pess_est_civil_id: "",

  // Campos de endereço
  logradouro: "",
  numero: "",
  bairro: "",
  complemento: "",
  cep: "",
  cidade: "",
  uf: "",
  notas_end: "",

  // Campos de campanha
  camp_gpo_id: "",
  camp_sit_id: "",
  notif_email: "",
  notif_whatsapp: "",
  valor: "",
  dt_adesao: "",
  dt_encerramento: "",
});

/**
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.post(route("pessoas.store"));
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
          <TabGroup>
            <TabList
              class="border-b space-x-2 border-gray-300 dark:border-gray-700"
            >
              <!-- TAB: Dados Pessoais -->
              <Tab as="template" v-slot="{ selected }" class="">
                <button
                  :class="[
                    '-mb-px py-3 px-4 text-sm border border-gray-300 text-gray-500 rounded-t-lg hover:bg-gray-100 hover:text-gray-900',
                    selected ? 'bg-white border-b-white' : 'bg-gray-50 ',
                  ]"
                >
                  Pessoais
                </button>
              </Tab>
              <!-- TAB: Endereço -->
              <Tab as="template" v-slot="{ selected }">
                <button
                  :class="[
                    '-mb-px py-3 px-4 text-sm border border-gray-300 text-gray-500 rounded-t-lg hover:bg-gray-100 hover:text-gray-900',
                    selected ? 'bg-white border-b-white' : 'bg-gray-50 ',
                  ]"
                >
                  Endereço
                </button>
              </Tab>
              <!-- TAB: Campanha -->
              <Tab as="template" v-slot="{ selected }">
                <button
                  :class="[
                    '-mb-px py-3 px-4 text-sm border border-gray-300 text-gray-500 rounded-t-lg hover:bg-gray-100 hover:text-gray-900',
                    selected ? 'bg-white border-b-white' : 'bg-gray-50 ',
                  ]"
                >
                  Campanha
                </button>
              </Tab>
            </TabList>

            <TabPanels>
              <!-- MESSAGES ERRORS -->
              <div class="mt-5" v-if="form.errors">
                <li
                  v-for="item in form.errors"
                  :key="item"
                  class="pl-1 flex text-sm text-red-600 bg-red-50 border-l-4 border-red-700"
                >
                  {{ item }}
                </li>
              </div>
              <!-- PAINEL: Dados Pessoais -->
              <TabPanel class="pt-5">
                <div class="md:flex gap-2 mb-4">
                  <!-- Campo Código -->
                  <div class="md:w-1/5">
                    <BizField
                      id="codigo"
                      label="Código"
                      :error="form.errors.codigo"
                    >
                      <BizInput
                        v-model="form.codigo"
                        placeholder="Digite um código"
                        type="text"
                      />
                    </BizField>
                  </div>

                  <!-- Campo Nome -->
                  <div class="md:w-4/5">
                    <BizField id="nome" label="Nome" :error="form.errors.nome">
                      <BizInput
                        v-model="form.nome"
                        placeholder="Digite um nome"
                        type="text"
                      />
                    </BizField>
                  </div>
                </div>

                <div class="md:flex gap-2 mb-4">
                  <!-- Campo Código -->
                  <div class="md:w-1/5">
                    <BizField
                      id="celular"
                      label="Celular"
                      :error="form.errors.celular"
                    >
                      <BizInput
                        v-model="form.celular"
                        placeholder="Digite um celular"
                        type="text"
                        v-maska data-maska="['(##) ####-####','(##) #####-####']"
                      />
                    </BizField>
                  </div>

                  <!-- Campo Nome -->
                  <div class="md:w-4/5">
                    <BizField
                      id="email"
                      label="E-mail"
                      :error="form.errors.email"
                    >
                      <BizInput
                        v-model="form.email"
                        placeholder="Digite um e-mail"
                        type="text"
                      />
                    </BizField>
                  </div>
                </div>

                <div class="md:flex gap-2 mb-4">
                  <!-- Campo Sexo -->
                  <div class="md:w-1/4">
                    <label class="mb-1 ml-1 inline-block text-sm text-gray-700"
                      >Sexo</label
                    >
                    <BaseListbox
                      v-model="form.sexo"
                      :options="list_sexos"
                      class="w-full"
                      :error="form.errors.sexo"
                    />
                  </div>
                  <!-- Campo Estado Civil -->
                  <div class="md:w-3/4">
                    <label class="mb-1 ml-1 inline-block text-sm text-gray-700"
                      >Estado Civil</label
                    >
                    <BaseListbox
                      v-model="form.pess_est_civil_id"
                      :options="list_est_civil"
                      class="w-full"
                      :error="form.errors.pess_est_civil_id"
                    />
                  </div>
                  <!-- Campo tipo -->
                  <div class="md:w-3/4">
                    <BizField
                      id="dt_nasc"
                      label="Data Nasc."
                      :error="form.errors.dt_nasc"
                    >
                      <BizInput
                        v-model="form.dt_nasc"
                        placeholder="Digite uma data"
                        type="text"
                        v-maska data-maska="##/##/####"
                      />
                    </BizField>
                  </div>
                  <!-- Campo tipo -->
                  <div class="md:w-3/4">
                    <BizField
                      id="dt_casamento"
                      label="Data Casamento"
                      :error="form.errors.dt_casamento"
                    >
                      <BizInput
                        v-model="form.dt_casamento"
                        placeholder="Digite uma data"
                        type="text"
                        v-maska data-maska="##/##/####"
                      />
                    </BizField>
                  </div>
                </div>

                <div class="md:flex gap-2 mb-4">
                  <!-- Campo Código -->
                  <div class="md:w-1/5">
                    <BizField
                      id="profissao"
                      label="Profissao"
                      :error="form.errors.profissao"
                    >
                      <BizInput
                        v-model="form.profissao"
                        placeholder="Digite uma profissão"
                        type="text"
                      />
                    </BizField>
                  </div>
                  <!-- Campo Nome -->
                  <div class="md:w-4/5">
                    <BizField
                      id="conjuge"
                      label="Conjuge"
                      :error="form.errors.conjuge"
                    >
                      <BizInput
                        v-model="form.conjuge"
                        placeholder="Digite um conjuge"
                        type="text"
                      />
                    </BizField>
                  </div>
                </div>

                <div class="md:flex gap-2 mb-4">
                  <!-- Campo Notas -->
                  <div class="md:w-full">
                    <BizField
                      id="notas"
                      label="Notas"
                      :error="form.errors.notas"
                    >
                      <BizInput
                        v-model="form.notas"
                        placeholder="Digite uma observação"
                        type="text"
                      />
                    </BizField>
                  </div>
                </div>
              </TabPanel>
              <!-- PAINEL: Endereço -->
              <TabPanel class="pt-5">
                <!-- Sub linha 01 -->
                <div class="md:flex gap-2 mb-4">
                  <!-- Campo logradouro -->
                  <div class="md:w-5/6">
                    <BizField
                      id="logradouro"
                      label="Logradouro"
                      :error="form.errors.logradouro"
                    >
                      <BizInput
                        v-model="form.logradouro"
                        placeholder="Digite um logradouro"
                        type="text"
                      />
                    </BizField>
                  </div>
                  <!-- Campo número -->
                  <div class="md:w-1/6">
                    <BizField
                      id="numero"
                      label="Número"
                      :error="form.errors.numero"
                    >
                      <BizInput
                        v-model="form.numero"
                        placeholder="Digite um número"
                        type="text"
                      />
                    </BizField>
                  </div>
                </div>

                <!-- Sub linha 02 -->
                <div class="md:flex gap-2 mb-4">
                  <!-- Campo logradouro -->
                  <div class="md:w-3/6">
                    <BizField
                      id="bairro"
                      label="Bairro"
                      :error="form.errors.bairro"
                    >
                      <BizInput
                        v-model="form.bairro"
                        placeholder="Digite um bairro"
                        type="text"
                      />
                    </BizField>
                  </div>
                  <!-- Campo número -->
                  <div class="md:w-2/6">
                    <BizField
                      id="complemento"
                      label="Complemento"
                      :error="form.errors.complemento"
                    >
                      <BizInput
                        v-model="form.complemento"
                        placeholder="Digite um complemento"
                        type="text"
                      />
                    </BizField>
                  </div>
                  <!-- Campo cep -->
                  <div class="md:w-1/6">
                    <BizField id="cep" label="Cep" :error="form.errors.cep">
                      <BizInput
                        v-model="form.cep"
                        placeholder="Digite um cep"
                        type="text"
                        v-maska data-maska="#####-###"
                      />
                    </BizField>
                  </div>
                </div>

                <!-- Sub linha 03 -->
                <div class="md:flex gap-2 mb-4">
                  <!-- Campo logradouro -->
                  <div class="md:w-5/6">
                    <BizField
                      id="cidade"
                      label="Cidade"
                      :error="form.errors.cidade"
                    >
                      <BizInput
                        v-model="form.cidade"
                        placeholder="Digite um cidade"
                        type="text"
                      />
                    </BizField>
                  </div>
                  <!-- Campo número -->
                  <div class="md:w-1/6">
                    <BizField id="uf" label="Estado" :error="form.errors.uf">
                      <BizInput
                        v-model="form.uf"
                        placeholder="Digite um estado"
                        type="text"
                        v-maska data-maska="@@"
                      />
                    </BizField>
                  </div>
                </div>
              </TabPanel>
              <!-- PAINEL: Campanha -->
              <TabPanel class="pt-5">
                <!-- Sub Form: Campanha -->

                <!-- Sub linha 01 -->
                <div class="md:flex gap-2 mb-4">
                  <!-- Campo Data adesão -->
                  <div class="md:w-1/4">
                    <BizField
                      id="dt_adesao"
                      label="Dt. Adesão"
                      :error="form.errors.dt_adesao"
                    >
                      <BizInput
                        v-model="form.dt_adesao"
                        placeholder="Digite uma data"
                        type="text"
                        v-maska data-maska="##/##/####"
                      />
                    </BizField>
                  </div>
                  <div class="md:w-1/4">
                    <BizField
                      id="valor"
                      label="Valor"
                      :error="form.errors.valor"
                    >
                      <BizInput
                        v-model="form.valor"
                        placeholder="Digite um valor"
                        type="text"
                        v-maska data-maska="0,99" data-maska-tokens="0:\d:multiple|9:\d:optional"
                      />
                    </BizField>
                  </div>
                  <!-- Campo Grupo -->
                  <div class="md:w-1/4">
                    <label class="mb-1 ml-1 inline-block text-sm text-gray-700"
                      >Grupo</label
                    >
                    <BaseListbox
                      v-model="form.camp_gpo_id"
                      :options="camp_gpos"
                      class="w-full"
                      :error="form.errors.camp_gpo_id"
                    />
                  </div>
                  <!-- Campo Situação -->
                  <div class="md:w-1/4">
                    <label class="mb-1 ml-1 inline-block text-sm text-gray-700"
                      >Situação</label
                    >
                    <BaseListbox
                      v-model="form.camp_sit_id"
                      :options="camp_sits"
                      class="w-full"
                      :error="form.errors.camp_sit_id"
                    />
                  </div>
                </div>

                <!-- Sub linha 02 -->
                <div class="md:flex gap-5 mb-4">
                  <!-- Check Notificar email -->
                  <div class="block">
                    <label class="flex items-center">
                      <input
                        type="checkbox"
                        v-model="form.notif_email"
                        :value="10"
                        class="w-5 h-5 border rounded border-gray-300 bg-gray-50 focus:ring-3 focus:ring-blue-300"
                      />
                      <span class="pl-1.5 text-sm">Notificar por E-mail</span>
                    </label>
                  </div>

                  <!-- Check Notificar WhatsApp -->
                  <div class="block ml-07">
                    <label class="flex items-center">
                      <input
                        type="checkbox"
                        v-model="form.notif_whatsapp"
                        :value="11"
                        class="w-5 h-5 border rounded border-gray-300 bg-gray-50 focus:ring-3 focus:ring-blue-300"
                      />
                      <span class="pl-1.5 text-sm">Notificar por WhatsApp</span>
                    </label>
                  </div>
                </div>
              </TabPanel>
            </TabPanels>
          </TabGroup>
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