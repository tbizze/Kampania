<script setup>
import { Head } from "@inertiajs/vue3";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <Head title="Dashboard" />
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <!-- <ApplicationLogo class="block h-12 w-auto" /> -->
            
            <div class="w-2/5">
                <img src="images/logo.png" style="background-size: contain;" >
            </div>

            <!-- background-image: url(https://theme.zdassets.com/theme_assets/9633455/9814df697eaf49815d7df109110815ff887b3457.png); -->
    

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Bem-vindo ao seu aplicativo de Gestão de Campanhas!
            </h1>

            <p class="mt-6 text-gray-500 leading-relaxed">
                <b>Kampania</b> é uma aplicação para cadastros e gestão de pessoas, e também oferece funcionalidades para o gerenciamento de campanhas de arrecadação. Com o Kampania, você pode facilmente cadastrar e gerenciar informações de pessoas, incluindo dados pessoais, informações de contato e histórico de doações. 
            </p>
            <p class="mt-3 text-gray-500 leading-relaxed">
                Além disso, o aplicativo permite que você crie e gerencie campanhas de arrecadação, com recursos para rastreamento de doações e relatórios de progresso. O Kampania também oferece relatórios detalhados sobre a evolução das campanhas, permitindo que você avalie o desempenho e faça ajustes conforme necessário. 
            </p>
            <p class="mt-3 text-gray-500 leading-relaxed">
                Com uma interface intuitiva e fácil de usar, o Kampania é uma ótima opção para organizações que buscam uma solução completa para gestão de pessoas e campanhas de arrecadação.
            </p>

        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                        Autenticação
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    Serviços de autenticação estão incluídas na aplicação, bem como suporte para verificação de e-mail do usuário e redefinição de senhas esquecidas. Também é possível usara autenticação de dois fatores.
                </p>
            </div>

            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-gray-900">
                        <a href="docs/Manual_sistema.pdf" target="_blank">Documentação</a>
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    O <b>Kampania</b> possui uma documentação maravilhosa cobrindo todos os recursos disponíveis. Quer você seja novo na utilização da aplicação, ou tenha experiência anterior, recomendamos a leitura de toda a documentação.
                </p>

                <p class="mt-4 text-sm">
                    <a href="docs/Manual_sistema.pdf" target="_blank" class="inline-flex items-center font-semibold text-indigo-700">
                        Explore a documentação

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </p>
            </div>
        </div>
    </div>
</template>
