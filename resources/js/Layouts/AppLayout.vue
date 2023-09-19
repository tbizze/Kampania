<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

import NavbarLayout from "@/Layouts/NavbarLayout.vue";
import ToastList from '@/Components/ToastList.vue';


defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <!-- ### SEÇÃO: Mensagens de alerta Toast -->
    <ToastList/>

    <div class="flex min-h-screen">
        <div class="w-64 py-5 px-3 bg-gray-800 border-r border-gray-700">
            <div class="mb-5 p-2">
                <a href="/" class="w-full flex items-center justify-center gap-3">
                    <ApplicationMark class="h-9" />
                    <span class="text-2xl text-gray-300">Kampania</span>
                </a>
            </div>

            <NavbarLayout />
        </div>
        <div class="flex-1 bg-gray-100">
            <!-- NavBar -->
            <div class="flex justify-between py-3 px-6 bg-white shadow border-b mb-2 space-x-6">
                <!-- LADO ESQUERDO: -->
                <div></div>
                <!-- LADO DIREITO: Settings Dropdown -->
                <div class="ml-3 relative">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button v-if="$page.props.jetstream.managesProfilePhotos"
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </button>

                            <span v-else class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ $page.props.auth.user.name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Gerenciar Conta
                            </div>

                            <DropdownLink :href="route('profile.show')">
                                Perfil
                            </DropdownLink>

                            <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                API Tokens
                            </DropdownLink>

                            <div class="border-t border-gray-200" />

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <DropdownLink as="button">
                                    Sair
                                </DropdownLink>
                            </form>
                        </template>
                    </Dropdown>
                </div>
            </div>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="">
                
                <!-- ### SEÇÃO: Mensagens de Alerta! -->
                <!-- <div v-if="$page.props.flash.success" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between"> -->
                    <!-- <div v-if="$page.props.flash.success" class="alert"> -->
                    <!-- <div class="flex flex-col"> -->
                        <!-- <Alert type="success">{{ $page.props.flash.success }}</Alert> -->
                    <!-- </div> -->
                    
                <!-- </div> -->

                <!-- ### SEÇÃO: Página a incorporar -->
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>

    </div>
</template>
