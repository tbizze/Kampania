<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.users')->only('index');
        $this->middleware('can:admin.users.create')->only('create','store');
        $this->middleware('can:admin.users.edit')->only('edit','update');
        $this->middleware('can:admin.users.delete')->only('destroy');
    }

     /**
     * Bloquear usuário.
     * NOTAS: Recebe um objeto como usuário a banir.
     */
    public function ban(User $user){

        //Aplicar proibição para a entidade
        //Verifique se a entidade não está banida: '!$user->isBanned();'
        if (!$user->isBanned()){
            $user->ban();
        } else {
            return redirect()->route('admin.users')->with('danger', 'O usuário já estava banido!');
        }

        // Redireciona para index.
        return redirect()->route('admin.users')->with('success', 'Usuário banido com sucesso!');
    }

    /**
     * Remove banimento ao usuário.
     * NOTAS: Recebe um objeto como usuário.
     */
    public function unBan(User $user){
        //Remover banimento da entidade
        //Todos os modelos de banimento relacionados há exclusões suaves.
        //Verifique se a entidade está banida: '$user->isBanned();'
        if ($user->isBanned()){
            $user->unban();
        } else {
            return redirect()->route('admin.users')->with('danger', 'O usuário não estava banido!');
        }
        // Redireciona para index.
        return redirect()->route('admin.users')->with('success', 'Usuário foi desbloqueado com sucesso!');
    }

    /**
     * Bloquear usuário.
     * NOTAS: Recebe um objeto como usuário a banir, e 
     * também um request com dados como comentário e data de expiração.
     */
    /* public function updateBan(Request $request, User $user){
        //Aplicar banimento para a entidade com comentário e data de expiração.
        $user->ban([
            'comment' => $request->comentario,
            'expired_at' => $request->expired_at,
        ]);

        //Aplicar banimento para a entidade que será excluída com o tempo
        //O atributo 'expired_at' pode ser uma instância '\Carbon\Carbon' ou qualquer string que possa ser analisada pelo método \Carbon\Carbon::parse($string)

        // Redireciona para index.
        return redirect()->route('admin.users')->with('success', 'Usuário foi bloqueado com sucesso!');
    } */

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Valida request
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email'],
        ]);

        // Chama os relacionamentos.
        $users = User::with('roles');
        
        // Se existe dados para filtrar no request (campo 'search'), monta Query com esse parâmetro.
        $users->when($request->search, function ($query, $vl){
            $query->where('name', 'like', '%' . $vl . '%');
            //dd('query',$query);
        });

        // Se existe dados de ordenamento no request, 
        // monta OrderBy com esse parâmetro.
        $users->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
            //dd('query',$query);
        });
        
        // Executa Query com paginação.
        $users = $users->paginate(10);

        // Define o título da página.
        $titulo = 'Usuários do Sistema';
        
        // Renderiza a View Inertia.
        return Inertia::render('Admin/UserIndex',[
            'titulo' => $titulo,
            'users' => $users,
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user_roles = $user->roles()->allRelatedIds();

        // Define o título da página.
        $titulo = 'Função Usuário';

        // Renderiza a View Inertia.
        return inertia::render('Admin/UserEdit',[
            'titulo'=> $titulo,
            'user' => $user,
            'roles' => $roles,
            'user_roles' => $user_roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request);
        $user->roles()->sync($request->user_roles);
        // Carrega na variável apenas os campos aprovados nas validações.
        //$input = $request->validated();

        // Redireciona para index.
        return redirect()->route('admin.users')->with('success', 'Funções atribuída a usuário com sucesso!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return 'destroy';
    }
}
