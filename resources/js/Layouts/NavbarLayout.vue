<script setup>
import {
  CubeIcon,
  CalendarIcon,
  ChatIcon,
  ClipboardListIcon,
  ClockIcon,
  HeartIcon,
  HomeIcon,
  SearchIcon,
  ChartBarIcon,
} from "@heroicons/vue/outline";

/* Criando uma Matriz de valores para montar os menus */
// MENU: Permissões
const menu_configs = [
  { href: "/admin/roles", label: "Funções", icon: ChatIcon, can: "Admin" },
  { href: "/admin/permissions", label: "Permissões", icon: CubeIcon, can: "Admin" },
  { href: "/admin/users", label: "Funções a usuários", icon: HeartIcon, can: "Admin" },
];

// MENU: Permissões
const menu_geral = [
  { href: "/dashboard", label: "Home", icon: HomeIcon, can: "Medio" },
];

// MENU: PESSOAS e CAMPANHA
const menu_pessoas = [
  { href: "/pessoas", label: "Pessoas", icon: CalendarIcon, can: "Medio" },
  { href: "/campanhas", label: "Campanha", icon: CubeIcon, can: "Admin" },
  { href: "/gestao-campanhas", label: "Gerir Campanhas", icon: ChartBarIcon, can: "Medio" },
];

// MENU: Perfil do usuário
const menu_perfil = [
  {
    href: "/user/profile",
    label: "Tiago Bizze",
    icon: CalendarIcon,
    imageUrl:"https://pbs.twimg.com/profile_images/1333896976602193922/MtWztkxt_400x400.jpg",
    can: "Medio",
  },
];

</script>


<template>
  <!-- #### MENU: GERAL -->
  <div class="mb-10">
    <!-- Label do Grupo -->
    <h3 class="mx-2 mb-2 text-xs text-gray-400 uppercase tracking-widest">
      Geral
    </h3>

    <!-- Loop dos Links -->
    <div v-for="(item, index) in menu_geral" :key="index">
      <a :href="item.href" v-if="$page.props.auth.user.roles.includes(item.can)"
        class="flex items-center p-2 text-base text-gray-300 rounded-lg transition duration-75 hover:text-gray-50 hover:bg-gray-700 group">
        <component :is="item.icon" class="h-5 w-5 text-gray-300 mr-2 group-hover:text-gray-50" />
        {{ item.label }}
      </a>
    </div>
  </div>


  <!-- #### MENU: PESSOAS -->
  <div class="mb-10">
    <!-- Label do Grupo -->
    <h3 class="mx-2 mb-2 text-xs text-gray-400 uppercase tracking-widest">
      Campanha
    </h3>

    <!-- Loop dos Links -->
    <div v-for="(item, index) in menu_pessoas" :key="index">
      <a :href="item.href" v-if="$page.props.auth.user.roles.includes(item.can)"
        class="flex items-center p-2 text-base text-gray-300 rounded-lg transition duration-75 hover:text-gray-50 hover:bg-gray-700 group">
        <component :is="item.icon" class="h-5 w-5 text-gray-300 mr-2 group-hover:text-gray-50" />
        {{ item.label }}
      </a>
    </div>
  </div>


  <!-- #### MENU CONFIGURAÇÕES -->
  <div class="mb-10">
    <!-- Label do Grupo -->
    <h3 class="mx-2 mb-2 text-xs text-gray-400 uppercase tracking-widest">
      Sistema
    </h3>

    <!-- Loop dos Links -->
    <div v-for="(item, index) in menu_configs" :key="index">
      <a :href="item.href" v-if="$page.props.auth.user.roles.includes(item.can)"
        class="flex items-center p-2 text-base text-gray-300 rounded-lg transition duration-75 hover:text-gray-50 hover:bg-gray-700 group">
        <component :is="item.icon" class="h-5 w-5 text-gray-300 mr-2 group-hover:text-gray-50" />
        {{ item.label }}
      </a>
    </div>
  </div>
  
  
  <!-- #### MENU PERFIL -->
  <div class="mb-10">
    <h3 class="mx-2 mb-2 text-xs text-gray-400 uppercase tracking-widest">
      Perfil
    </h3>
    <!-- Loop dos Links -->
    <div v-for="(item, index) in menu_perfil" :key="index">
      <a :href="item.href" v-if="$page.props.auth.user.roles.includes(item.can)"
        class="flex items-center p-2 text-base text-gray-300 rounded-lg transition duration-75 hover:text-gray-50 hover:bg-gray-700 group">
        <img :src="item.imageUrl" alt="" class="w-7 h-7 rounded-full mr-2" />
        <!-- {{ item.label }} --> {{ $page.props.auth.user.name }}
      </a>
    </div>
  </div>
</template>

<style></style>