<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Http\Requests\StorePessoaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Models\CampGpo;
use App\Models\CampSit;
use App\Models\PessEstCivil;
use App\Models\PessGpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PessoaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pessoas.index')->only('index');
        $this->middleware('can:pessoas.create')->only('create','store');
        $this->middleware('can:pessoas.edit')->only('edit',);
        $this->middleware('can:pessoas.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->grupo_id);
        // Verifica se o campo 'grupo_id' tem dados. Se tiver irá limpar.
        /* if ($request->grupo_id){
            $request->grupo_id = preg_replace('/[^\d\-]/','', $request->grupo_id); // limpa permitindo somente números.
            $request->grupo_id = array_map('intval', $request->grupo_id); // transforma o array string em array number.
        } */

        // 1) Valida os dados submetidos
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field'     => ['in:nome'],
        ]);

        // 2) Instancia o modelo:
        // Se houver relacionamentos => with('roles') ou então query().
        $pessoas = Pessoa::with('grupos');
        
        
        // 3) Aplica filtros a Query:
        // Se passado dados no campo 'search' ==> Pesquisa na coluna 'description'.
        $pessoas->when($request->search, function ($query, $vl){
            $query->where('nome', 'like', '%' . $vl . '%');
        });
        // Se passado dados no SelectBox 'grupo_id' ==> Pesquisa os ID's passados.
        $pessoas->when($request->grupo_id, function ($query, $vl){
            $query->whereIn('lcto_grupo_id', $vl);
        });
        
        // 4) Aplica ordem a Query
        // Se acionado alguma coluna de ordenar, realiza o OrderBy.
        $pessoas->when($request->field, 
            function ($query, $vl){
                $query->orderBy($vl, request()->direction);
            }, 
            // Ordenamento padrão: ID ascendente
            function ($query, $vl){
                $query->orderBy('id', 'desc');
            });
        
        // 5) Executa a Query montada com paginação.
        $pessoas = $pessoas->paginate(10);

        // Define o título da página.
        $titulo = 'Pessoas';

        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $grupos = PessGpo::get(['id as value', 'nome as label']);
        //$grupos = PessGpo::pluck('nome','id');
//dd($pessoas,$grupos);
        // Renderiza a View Inertia.
        return Inertia::render('Pessoa/Index',[
            'titulo' => $titulo,
            'dados' => $pessoas,
            'filters' => $request,
            'grupos' => $grupos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //dd('create');

        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $list_est_civil = PessEstCivil::get(['id as value', 'nome as label']);
        $camp_gpos = CampGpo::get(['id as value', 'nome as label']);
        $camp_sits = CampSit::get(['id as value', 'nome as label']);
        
        // Monta os tipos para passar ao ListBox.
        $list_sexos = [
            0 => [
                'value' => 'M',
                'label' => 'Masculino',
            ],[
                'value' => 'F',
                'label' => 'Feminino',
            ]            
        ];

        // Define o título da página.
        $titulo = 'Criar Pessoas';

        // Renderiza a View Inertia.
        return Inertia::render('Pessoa/Create',[
            'titulo' => $titulo,
            'list_est_civil' => $list_est_civil,
            'list_sexos' => $list_sexos,
            'camp_gpos' => $camp_gpos,
            'camp_sits' => $camp_sits,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePessoaRequest $request)
    {
        //dd($request->getContent());

        // Cria um model com os dados aprovados nas validações...
        // Persiste o model atualizado no DB.
        DB::transaction(function () use($request) {
            $pessoa = Pessoa::create($request->validated());
            
            // Associa Pessoa criada a um grupo de pessoas [1- Campanha].
            /* $pessoa_id = 1;
            $pessoa->grupos()->sync($pessoa_id,false); */
/* dd($request->boolean('notif_email'));
            if($request->notif_email){
                dd('teste');
            }; */
            
            // Associa Pessoa criada a um grupo de pessoas [1- Campanha 2022].
            $campanha_id = 1;
            $pessoa->campanhaItens()->attach($campanha_id,[
                'notif_email' => $request->notif_email, 
                'notif_whatsapp' => $request->notif_whatsapp,
                'valor' => $request->valor,
                'dt_adesao' => $request->dt_adesao,
                'dt_encerramento' => $request->dt_encerramento,
                'camp_gpo_id' => $request->camp_gpo_id,
                'camp_sit_id' => $request->camp_sit_id,
            ]);
        });

        // Redireciona para index.
        return redirect()->route('pessoas.index')->with('success', 'Registro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pessoa $pessoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pessoa $pessoa)
    {
        //dd('edit', $this->mskfone($pessoa->celular));
        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $list_est_civil = PessEstCivil::get(['id as value', 'nome as label']);
        $camp_gpos = CampGpo::get(['id as value', 'nome as label']);
        $camp_sits = CampSit::get(['id as value', 'nome as label']);
        
        // Monta os tipos para passar ao ListBox.
        $list_sexos = [
            0 => [
                'value' => 'M',
                'label' => 'Masculino',
            ],[
                'value' => 'F',
                'label' => 'Feminino',
            ]            
        ];

        // Carrega o relacionamento
        //$pessoa->load('campanhaItens');
        //dd($pessoa);
        
        //$campanha = Pessoa::with('campanhas');

        // Define o título da página.
        $titulo = 'Editar Pessoas';

        // Renderiza a View Inertia.
        return Inertia::render('Pessoa/Edit',[
            'titulo' => $titulo,
            'registro' => $pessoa,
            'list_est_civil' => $list_est_civil,
            'list_sexos' => $list_sexos,
            'camp_gpos' => $camp_gpos,
            'camp_sits' => $camp_sits,
            //'campanha' => $campanha,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePessoaRequest $request, Pessoa $pessoa)
    {
        //dd('update');

        // Carrega no model atual os dados aprovados nas validações, para persistir no DB.
        $pessoa->fill($request->validated());
        // Persiste o model atualizado no DB.
        $pessoa->save();

        // Redireciona para index.
        return redirect()->route('pessoas.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        //dd('destroy');
        // Exclui do DB o registro.
        $pessoa->delete();
        
        // Redireciona para index.
        return redirect()->route('pessoas.index')->with('danger', 'Registro excluído com sucesso!');
    }
}
