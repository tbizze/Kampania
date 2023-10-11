<!-- CRÉDITOS:
     https://www.youtube.com/watch?v=bIZBNYFXcKU&t=36s
     Canal => cdruc
-->
<script setup>
import { ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3'

import { Toast } from 'flowbite-vue'

const page = usePage();

const success = ref([
    /* {message: 'Registro salvo com sucesso.'}, */
])
const warning = ref([
    /* {message: 'Registro salvo com sucesso.'}, */
])
const danger = ref([
    /* {message: 'Registro salvo com sucesso.'}, */
])

// Ao terminar a renderização, verifica se há mensagens de alerta.
router.on('finish', ()=>{
    // Se há mensagem de sucesso.
    if (page.props.flash.success){
        success.value.unshift({
            message: page.props.flash.success
        });
    }
    // Se há mensagem de alerta.
    if (page.props.flash.warning){
        warning.value.unshift({
            message: page.props.flash.warning
        });
    }
    // Se há mensagem de erro.
    if (page.props.flash.danger){
        danger.value.unshift({
            message: page.props.flash.danger
        });
    }
})
</script>
<template>
    <div class="fixed top-10 right-10 z-50 space-y-3 w-full max-w-xs ">
        <!-- ### Success: Mensagens de sucesso -->
        <Toast
            v-for="(item, index) in success"
            :key="index"
            :message="item.message"
            type="success"
            closable
            class="border border-l-4 border-l-green-400 rounded-md shadow-sm"
        >{{ item.message }}</Toast>

        <!-- ### Warning: Mensagens de alerta -->
        <Toast
            v-for="(item, index) in warning"
            :key="index"
            :message="item.message"
            type="warning"
            closable
            class="border border-l-4 border-l-orange-400 rounded-md shadow-sm"
        >{{ item.message }}</Toast>

        <!-- ### Danger: Mensagens de erro -->
        <Toast
            v-for="(item, index) in danger"
            :key="index"
            :message="item.message"
            type="danger"
            closable
            class="border border-l-4 border-l-red-500 rounded-md shadow-sm"
        >{{ item.message }}</Toast>
    </div>
</template>