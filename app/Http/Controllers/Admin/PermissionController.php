<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.permissions')->only('index');
        $this->middleware('can:admin.permissions.create')->only('create','store');
        $this->middleware('can:admin.permissions.edit')->only('edit','update');
        $this->middleware('can:admin.permissions.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1) Valida os dados submetidos
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,model'],
        ]);

        
        // 2) Instancia o modelo:
        // Se houver relacionamentos => with('roles') ou então query().
        $permissions = Permission::with('roles'); 
        
        // 3) Aplica filtros a Query:
        // Se passado dados no campo 'search' ==> Pesquisa na coluna 'description' e na 'name'.
        $permissions->when($request->search, function ($query, $vl){
            $query->where('description', 'like', '%' . $vl . '%')
                  ->orWhere('name', 'like', '%' . $vl . '%');
        });
        
        // 4) Aplica ordem a Query
        // Se acionado alguma coluna de ordenar, realiza o OrderBy.
        $permissions->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
        });
        
        // 5) Executa a Query montada com paginação.
        $permissions = $permissions->paginate(10);
        
        // Define o título da página.
        $titulo = 'Permissões do Sistema';
        
        // Renderiza a View Inertia.
        return Inertia::render('Admin/PermissionIndex',[
            'titulo' => $titulo,
            'permissions' => $permissions,
            'filters' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        //$permission_roles = $permission->roles()->allRelatedIds();

        // Define o título da página.
        $titulo = 'Criar Permissões';
        
        // Renderiza a View Inertia.
        return Inertia::render('Admin/PermissionCreate',[
            'titulo' => $titulo,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            //'name' => 'required|unique:permissions',
            'name' => 'required',
            'description' => 'required|string',
            'model' => 'required|string',
            'guard_name' => 'required|string',
            'roles' => 'array',
        ]);

        // Carrega na variável apenas os campos aprovados nas validações.
        //$input = $request->validated();
        // Persiste model criado no DB.
        $permission = Permission::create($validated);
        
        // Atribui as funções passadas, à permissão criada.
        if ($request->roles){
            $permission->roles()->sync($request->roles);
        }        

        // Redireciona para index.
        return redirect()->route('admin.permissions');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        // Obtém todas as funções.        
        $roles = Role::all();
        // Obtém as funções relacionadas com a permissão atual.
        // Método pluck('role_id') coloca a coluna definida num array.
        $permission_roles = DB::table('role_has_permissions')->where('permission_id',$permission->id)->pluck('role_id');

        // Define o título da página.
        $titulo = 'Editar Permissões';
        
        // Renderiza a View Inertia.
        return Inertia::render('Admin/PermissionEdit',[
            'titulo' => $titulo,
            'permission' => $permission,
            'roles' => $roles,
            'permission_roles' => $permission_roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        
        $validated = $request->validate([
            //'name' => 'required|unique:permissions',
            'name' => 'required',
            'description' => 'required|string',
            'model' => 'required|string',
            'permission_roles' => 'array',
        ]);
        
        // Carrega na variável apenas os campos aprovados nas validações.
        //$input = $request->validated();
        
        // Carrega no model os dados carregados na variável, para persistir no DB.
        $permission->fill($validated);
        // Persiste model atualizado no DB.
        $permission->save($validated);

        // Atribui as funções passadas, à permissão criada.
        if ($request->permission_roles){
            $permission->roles()->sync($request->permission_roles);
        }        


        // Redireciona para index.
        return redirect()->route('admin.permissions')->with('success', 'Permissão salva com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        return 'apagar' . $permission->id;
    }
}
