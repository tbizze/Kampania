<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles and assign existing permissions
        $role1 = Role::create([
            'name' => 'Admin',
            'description' => 'Usuário super administrador. Acesso total, inclusive administra usuários e permissões.'
        ]);
        $role2 = Role::create([
            'name' => 'Medio',
            'description' => 'Usuário com amplos poderes no sistema, com exceção na administração de usuários e permissões.'
        ]); 
        $role3 = Role::create([
            'name' => 'Basico',
            'description' => 'Usuário com poucas permissões, apenas consultar.'
        ]); 

        /**
         * ### CRIAR PERMISSÕES ########################
         * Além de criar as permissões, já lhe atribui funções através do método syncRoles()
        */

        // ### SEGURANÇA: 
        // Administrar atribuições de funções(permissões) a usuários
        Permission::create([
            'name'          => 'admin.users',
            'description'   => 'Ver usuários',
            'model'         => 'SEG: Usuário',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.users.edit',
            'description'   => 'Editar usuários',
            'model'         => 'SEG: Usuário',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.users.delete',
            'description'   => 'Deletar usuários',
            'model'         => 'SEG: Usuário',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.users.ban',
            'description'   => 'Bloquear usuários',
            'model'         => 'SEG: Usuário',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.users.unban',
            'description'   => 'Desbloquear usuários',
            'model'         => 'SEG: Usuário',
        ])->syncRoles([$role1]);

        // Administrar funções da aplicação
        Permission::create([
            'name'          => 'admin.roles',
            'description'   => 'Ver funções',
            'model'         => 'SEG: Funções',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.roles.edit',
            'description'   => 'Editar funções',
            'model'         => 'SEG: Funções',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.roles.delete',
            'description'   => 'Deletar funções',
            'model'         => 'SEG: Funções',
        ])->syncRoles([$role1]);

        // Administrar permissões da aplicação
        Permission::create([
            'name'          => 'admin.permissions',
            'description'   => 'Ver permissões',
            'model'         => 'SEG: Permissões',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.permissions.edit',
            'description'   => 'Editar permissões',
            'model'         => 'SEG: Permissões',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.permissions.delete',
            'description'   => 'Deletar permissões',
            'model'         => 'SEG: Permissões',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.permissions.create',
            'description'   => 'Criar permissões',
            'model'         => 'SEG: Permissões',
        ])->syncRoles([$role1]);

        
        // Acesso a Pessoas
        Permission::create([
            'name'          => 'pessoas.index',
            'description'   => 'Ver Pessoas',
            'model'         => 'Pessoa',
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name'          => 'pessoas.create',
            'description'   => 'Criar Pessoas',
            'model'         => 'Pessoa',
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name'          => 'pessoas.edit',
            'description'   => 'Editar Pessoas',
            'model'         => 'Pessoa',
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name'          => 'pessoas.destroy',
            'description'   => 'Deletar Pessoas',
            'model'         => 'Pessoa',
        ])->syncRoles([$role1,$role2]);


        // Acesso a Gerir Campanha
        Permission::create([
            'name'          => 'gestao_campanhas.index',
            'description'   => 'Ver Dados Campanha',
            'model'         => 'CampGerir',
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name'          => 'gestao_campanhas.create',
            'description'   => 'Criar Dados Campanha',
            'model'         => 'CampGerir',
        ])->syncRoles([$role1,]);
        Permission::create([
            'name'          => 'gestao_campanhas.edit',
            'description'   => 'Editar Dados Campanha',
            'model'         => 'CampGerir',
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name'          => 'gestao_campanhas.destroy',
            'description'   => 'Deletar Dados Campanha',
            'model'         => 'CampGerir',
        ])->syncRoles([$role1,]);

        // Acesso a Campanha
        Permission::create([
            'name'          => 'campanhas.index',
            'description'   => 'Ver Campanhas',
            'model'         => 'Campanha',
        ])->syncRoles([$role1,]);
        Permission::create([
            'name'          => 'campanhas.create',
            'description'   => 'Criar Campanhas',
            'model'         => 'Campanha',
        ])->syncRoles([$role1,]);
        Permission::create([
            'name'          => 'campanhas.edit',
            'description'   => 'Editar Campanhas',
            'model'         => 'Campanha',
        ])->syncRoles([$role1,]);
        Permission::create([
            'name'          => 'campanhas.destroy',
            'description'   => 'Deletar Campanhas',
            'model'         => 'Campanha',
        ])->syncRoles([$role1,]);
        
    }
}
