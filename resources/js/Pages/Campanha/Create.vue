<script setup>
import { router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

import BaseListbox from "@/Components/BizListbox.vue";
import BizInput from "@/Components/BizInput.vue";
import BizField from "@/Components/BizField.vue";
import BizButtonSave from "@/Components/BizButtonSave.vue";
import BizButtonCancel from "@/Components/BizButtonCancel.vue";

//import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
  titulo: "", 
  list_est_civil: Object,
  list_sexos: Object,
  camp_gpos: Object,
  camp_sits: Object,
});

const form = useForm({
  codigo: '',
  nome: '',
  sexo: '',
  dt_nasc: '',
  dt_casamento: '',
  conjuge: '',
  profissao: '',
  rg_ie: '',
  cpf_cnpj: '',
  email: '',
  celular: '',
  notas: '',
  pess_est_civil_id: '',
  
  camp_gpo_id: '',
  camp_sit_id: '',
  notif_email: '',
  notif_whatsapp: '',
  valor: '',
  dt_adesao: '',
  dt_casamento: '',
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
                <BizInput v-model="form.codigo" placeholder="Definir código" type="text" />
              </BizField>
            </div>

            <!-- Campo Nome -->
            <div class="md:w-4/5">
              <BizField id="nome" label="Nome" :error="form.errors.nome">
                <BizInput v-model="form.nome" placeholder="Registre um nome" type="text" />
              </BizField>
            </div>
          </div>


          <div class="md:flex gap-2 mb-4">
            <!-- Campo Código -->
            <div class="md:w-1/5">
              <BizField id="codigo" label="Celular" :error="form.errors.celular">
                <BizInput v-model="form.celular" placeholder="Definir código" type="text" />
              </BizField>
            </div>

            <!-- Campo Nome -->
            <div class="md:w-4/5">
              <BizField id="nome" label="E-mail" :error="form.errors.email">
                <BizInput v-model="form.email" placeholder="Registre um nome" type="text" />
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
              <BizField id="valor" label="Data Nasc." :error="form.errors.dt_nasc">
                <BizInput v-model="form.dt_nasc" placeholder="Definir valor" type="text" />
              </BizField>
            </div>
            <!-- Campo tipo -->
            <div class="md:w-3/4">
              <BizField id="valor" label="Data Casamento" :error="form.errors.dt_casamento">
                <BizInput v-model="form.dt_casamento" placeholder="Definir valor" type="text" />
              </BizField>
            </div>
          </div>


          <div class="md:flex gap-2 mb-4">
            <!-- Campo Código -->
            <div class="md:w-1/5">
              <BizField id="codigo" label="Profissao" :error="form.errors.profissao">
                <BizInput v-model="form.profissao" placeholder="Definir código" type="text" />
              </BizField>
            </div>
            <!-- Campo Nome -->
            <div class="md:w-4/5">
              <BizField id="nome" label="Conjuge" :error="form.errors.conjuge">
                <BizInput v-model="form.conjuge" placeholder="Registre um nome" type="text" />
              </BizField>
            </div>
          </div>
          

          <div class="md:flex gap-2 mb-4">
            <!-- Campo Notas -->
            <div class="md:w-full">
              <BizField id="notas" label="Notas" :error="form.errors.notas">
                <BizInput v-model="form.notas" placeholder="Registre uma nota." type="text" />
              </BizField>
            </div>
          </div>

          <!-- Sub Form: Campanha -->
          <div class=" mt-10 mb-8 border-2 p-4">
            <!-- Sub linha 01 -->
            <div class="md:flex gap-2 mb-4">
              <!-- Campo Data adesão -->
              <div class="md:w-1/5">
                <BizField id="dt_adesao" label="Dt. Adesão" :error="form.errors.dt_adesao">
                  <BizInput v-model="form.dt_adesao" placeholder="Definir código" type="text" />
                </BizField>
              </div>
              <!-- Campo Data Encerramento -->
              <div class="md:w-1/5">
                <BizField id="dt_encerramento" label="Dt. Encerramento" :error="form.errors.dt_encerramento">
                  <BizInput v-model="form.dt_encerramento" placeholder="Definir código" type="text" />
                </BizField>
              </div>
              <!-- Campo Valor -->
              <div class="md:w-1/5">
                <BizField id="valor" label="Valor" :error="form.errors.valor">
                  <BizInput v-model="form.valor" placeholder="Definir código" type="text" />
                </BizField>
              </div>
              <!-- Campo Grupo -->
              <div class="md:w-1/4">
                <label class="mb-1 ml-1 inline-block text-sm text-gray-700">Grupo</label>
                <BaseListbox
                  v-model="form.camp_gpo_id"
                  :options="camp_gpos"
                  class="w-full"
                  :error="form.errors.camp_gpo_id"
                />
              </div>
              <!-- Campo Situação -->
              <div class="md:w-1/4">
                <label class="mb-1 ml-1 inline-block text-sm text-gray-700">Situação</label>
                <BaseListbox
                  v-model="form.camp_sit_id"
                  :options="camp_sits"
                  class="w-full"
                  :error="form.errors.camp_sit_id"
                />
              </div>
            </div>
            
            <!-- Sub linha 02 -->
            <div class="md:flex gap-2 mb-4">
              <!-- Check Notificar email -->
              <div class="block">
                <!-- <label class="flex items-center">
                  <Checkbox v-model:checked="form.notif_email" name="notif_email" class="w-5 h-5" />
                  <span class="ml-2 text-sm text-gray-600">Notificar por e-mail</span>
                </label> -->
                <label class="flex items-center">
                  <input type="checkbox" v-model="form.notif_email" :value="10"
                    class="w-5 h-5 border rounded border-gray-300  bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                  <span class="pl-1.5 text-sm">Notificar por E-mail</span>
                </label>
              </div>

              <!-- Check Notificar WhatsApp -->
              <div class="block ml-07">
                <!-- <label class="flex items-center">
                  <Checkbox v-model="form.notif_whatsapp" name="notif_whatsapp" class="w-5 h-5" />
                  <span class="ml-2 text-sm text-gray-600">Notificar por WhatsApp</span>
                </label> -->
                <label class="flex items-center">
                  <input type="checkbox" v-model="form.notif_whatsapp" :value="10"
                    class="w-5 h-5 border rounded border-gray-300  bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                  <span class="pl-1.5 text-sm">Notificar por WhatsApp</span>
                </label>
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