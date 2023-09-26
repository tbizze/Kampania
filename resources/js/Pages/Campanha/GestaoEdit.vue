<script setup>
import { router, useForm, Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionPageForm from "@/Components/SectionPageForm.vue";

import BaseListbox from "@/Components/BizListbox.vue";
import BizInput from "@/Components/BizInput.vue";
import BizField from "@/Components/BizField.vue";
import BizButtonSave from "@/Components/BizButtonSave.vue";
import BizButtonCancel from "@/Components/BizButtonCancel.vue";

import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
  titulo: "",
  registro: Object,
  list_est_civil: Object,
  list_sexos: Object,
  camp_gpos: Object,
  camp_sits: Object,
});

const form = useForm({
  dt_adesao: props.registro.dt_adesao,
  dt_encerramento: props.registro.dt_encerramento,
  valor: props.registro.valor,
  notif_email: Boolean(props.registro.notif_email),
  notif_whatsapp: Boolean(props.registro.notif_whatsapp),
  camp_sit_id: props.registro.camp_sit_id,
  camp_gpo_id: props.registro.camp_gpo_id,
  id: props.registro.id,
});

/** 
 * Função para submeter o formulário.
 * Persiste no BD.
 */
function submit() {
  form.put(route("gestao-campanhas.update", props.registro.id));
}

/**
 * Função para cancelar o cadastro.
 * Volta para a listagem.
 */
function cancelSave() {
  router.get(route("gestao-campanhas.index"));
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
        
        <div class="md:flex gap-2 mb-4">
          <!-- Campo Código -->
          <div class="md:w-1/5">
            <label class="text-sm text-gray-700">Código</label>
            <span class=" block">{{ registro.to_pessoa.codigo }}</span>
          </div>

          <!-- Campo Nome -->
          <div class="md:w-3/5">
            <label class="text-sm text-gray-700">Nome</label>
            <span class=" block">{{ registro.to_pessoa.nome }}</span>
          </div>

          <!-- Campo Nome -->
          <div class="md:w-1/5">
            <label class="text-sm text-gray-700">Dt. Nasc.</label>
            <span class=" block">{{ registro.to_pessoa.dt_nasc }}</span>
          </div>
        </div>

        <div class="md:flex gap-2 mb-4">
          <!-- Campo Código -->
          <div class="md:w-1/5">
            <label class="text-sm text-gray-700">Celular</label>
            <span class=" block">{{ registro.to_pessoa.celular }}</span>
          </div>

          <!-- Campo Nome -->
          <div class="md:w-4/5">
            <label class="text-sm text-gray-700">E-mail</label>
            <span class=" block">{{ registro.to_pessoa.email }}</span>
          </div>
        </div>

        <form @submit.prevent="submit()">
          <div class=" mt-10 mb-8 border-2 p-4">
            <!-- Sub linha 01 -->
            <div class="md:flex gap-2 mb-4">
              <!-- Campo Código -->
              <div class="md:w-1/5">
                <BizField id="dt_adesao" label="Dt. Adesão" :error="form.errors.dt_adesao">
                  <BizInput v-model="form.dt_adesao" placeholder="Digitar uma data" type="text" />
                </BizField>
              </div>
              <!-- Campo Nome -->
              <div class="md:w-1/5">
                <BizField id="dt_encerramento" label="Dt. Encerramento" :error="form.errors.dt_encerramento">
                  <BizInput v-model="form.dt_encerramento" placeholder="Digitar uma data" type="text" />
                </BizField>
              </div>
              <!-- Campo Nome -->
              <div class="md:w-1/5">
                <BizField id="valor" label="Valor" :error="form.errors.valor">
                  <BizInput v-model="form.valor" placeholder="Digitar um valor" type="text" />
                </BizField>
              </div>
              <!-- Campo Estado Civil -->
              <div class="md:w-1/4">
                <label class="mb-1 ml-1 inline-block text-sm text-gray-700">Grupo</label>
                <BaseListbox
                  v-model="form.camp_gpo_id"
                  :options="camp_gpos"
                  class="w-full"
                  :error="form.errors.camp_gpo_id"
                />
              </div>
              <!-- Campo Nome -->
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
            <div class="md:flex gap-5 mb-4">
              <!-- Check Notificar email -->
              <div class="block">
                <label class="flex items-center">
                  <Checkbox v-model:checked="form.notif_email" name="notif_email" value="10" />
                  <span class="pl-1.5 text-sm">Notificar por e-mail</span>
                </label>
              </div>

              <!-- Check Notificar WhatsApp -->
              <div class="block ml-07">
                <label class="flex items-center">
                  <Checkbox v-model:checked="form.notif_whatsapp" name="notif_whatsapp" value="11" />
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