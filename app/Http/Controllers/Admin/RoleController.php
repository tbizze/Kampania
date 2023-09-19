<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.roles')->only('index');
        $this->middleware('can:admin.roles.create')->only('create','store');
        $this->middleware('can:admin.roles.edit')->only('edit','update');
        $this->middleware('can:admin.roles.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1) Valida os dados submetidos
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name'],
        ]);

        // 2) Instancia o modelo:
        // Se houver relacionamentos => with('roles') ou então query().
        $roles = Role::with('permissions');
        
        // 3) Aplica filtros a Query:
        // Se passado dados no campo 'search' ==> Pesquisa na coluna 'description'.
        $roles->when($request->search, function ($query, $vl){
            $query->where('name', 'like', '%' . $vl . '%');
        });
        
        // 4) Aplica ordem a Query
        // Se acionado alguma coluna de ordenar, realiza o OrderBy.
        $roles->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
        });
        
        // 5) Executa a Query montada com paginação.
        $roles = $roles->paginate(10);

        // Define o título da página.
        $titulo = 'Funções do Sistema';

        return Inertia::render('Admin/RoleIndex',[
            'titulo' => $titulo,
            'roles' => $roles,
            'filters' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        $arrMeses = [
            Permission::all()->pluck('model')
        ];
        $itens = Permission::select(DB::raw('model, name, id'))
          //->groupBy(DB::raw("model"))
          ->orderBy('model')
          //->lists('id', 'model')
          //->pluck();
          ->get();
          //dd('itens',$itens);
        
        // Lista de Modelos, pegando somente um de cada. Não se repete.
        $permissions_models = Permission::select(DB::raw('model'))
          ->groupBy(DB::raw("model"))
          ->orderBy('model')
          ->get();

    
        $role_permissions = $role->permissions->pluck('id');
        //$role_permissions = $role->permissions()->allRelatedIds(); // o mesmo q linha acima.


        //dd($role_permissions);
        
        // Define o título da página.
        $titulo = 'Função Usuário';

        return Inertia::render('Admin/RoleEdit',[
            'titulo' => $titulo,
            'role' => $role,
            'permissions' => $permissions,
            'role_permissions' => $role_permissions,
            'permissions_models' => $permissions_models,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //dd($request,$role);
        //$role->roles()->sync($request->roles);
        $role->syncPermissions($request->permissions);
        // Carrega na variável apenas os campos aprovados nas validações.
        //$input = $request->validated();
        
        // Carrega no model os dados carregados na variável, para persistir no DB.
        //$lctoGrupo->fill($input);
        // Persiste model atualizado no DB.
        //$lctoGrupo->save($input);

        // Redireciona para index.
        return redirect()->route('admin.roles')->with('success', 'Permissões atribuídas a usuário com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
