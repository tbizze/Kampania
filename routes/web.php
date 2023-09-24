<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/**
 * ROTAS DE TESTES:
 */
Route::get('/test', [HomeController::class, 'test'])->name('test');






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'forbid-banned-user', //Bloquear acesso a usuários banidos.
    //'logs-out-banned-user', //Forçar a exclusão da sessão de usuários banidos.
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ROTAS COM AUTENTICAÇÃO
    |--------------------------------------------------------------------------
    | Rotas protegidas por autenticação.
    | Se tentar acessá-las sem estar logado, será redirecionado à página de login.
    */

    /**
     * Página inicial após logar.
     */
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /**
     * #### ATRIBUIÇÃO DE FUNÇÕES #########################
     */
    Route::prefix('admin/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users');
        // Criar
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        // Editar
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
        // Deletar
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');

        Route::put('/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
        Route::put('/{user}/unBan', [UserController::class, 'unBan'])->name('admin.users.unBan');
        //Route::put('/{user}/updateBan', [UserController::class,'updateBan'])->name('admin.users.updateBan');
    });

    /**
     * #### FUNÇÕES #########################
     */
    Route::prefix('admin/roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('admin.roles');
        // Criar
        Route::get('/create', [RoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('admin.roles.store');
        // Editar
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
        // Deletar
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('admin.roles.delete');
    });

    /**
     * #### PERMISSÕES #########################
     */
    Route::prefix('admin/permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permissions');
        // Criar
        Route::get('/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
        Route::post('/', [PermissionController::class, 'store'])->name('admin.permissions.store');
        // Editar
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
        // Deletar
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.delete');
    });
});
