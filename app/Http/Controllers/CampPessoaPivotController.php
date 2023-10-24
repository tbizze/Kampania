<?php

namespace App\Http\Controllers;

use App\Models\CampPessoaPivot;
use App\Http\Requests\StoreCampPessoaPivotRequest;
use App\Http\Requests\UpdateCampPessoaPivotRequest;
use App\Models\CampGpo;
use App\Models\CampSit;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CampPessoaPivotController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:gestao_campanhas.index')->only('index');
        $this->middleware('can:gestao_campanhas.create')->only('create', 'store');
        $this->middleware('can:gestao_campanhas.edit')->only('edit',);
        $this->middleware('can:gestao_campanhas.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->grupo_id);
        // Verifica se o campo 'grupo_id' tem dados. Se tiver irá limpar.
        /* if ($request->camp_gpo_id){
            $request->camp_gpo_id = preg_replace('/[^\d\-]/','', $request->camp_gpo_id); // limpa permitindo somente números.
            $request->camp_gpo_id = array_map('intval', $request->camp_gpo_id); // transforma o array string em array number.
        }
        if ($request->camp_sit_id){
            $request->camp_sit_id = preg_replace('/[^\d\-]/','', $request->camp_sit_id); // limpa permitindo somente números.
            $request->camp_sit_id = array_map('intval', $request->camp_sit_id); // transforma o array string em array number.
        } */

        // 1) Valida os dados submetidos
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field'     => ['in:nome'],
        ]);

        // 2) Instancia o modelo:
        // Chama a tabela principal e estabelece os relacionamentos.
        $campanhas = CampPessoaPivot::with(['toPessoa', 'toGrupo', 'toSituacao'])
            ->addSelect([
                // alias da sub-select
                'nome' => Pessoa::query()
                    // You can use eloquent methods here
                    ->select('nome')
                    ->whereColumn('id', 'pessoa_id')
                    ->latest()
                    ->take(1),
                // alias da sub-select
                'codigo' => Pessoa::query()
                    // You can use eloquent methods here
                    ->select('codigo')
                    ->whereColumn('id', 'pessoa_id')
                    ->latest()
                    ->take(1)
            ]);

        // 3) Aplica filtros a Query:
        // Se passado dados no campo 'search' ==> Pesquisa na coluna 'nome'.
        $campanhas->when($request->search, function ($query, $vl) {
            $query->where(DB::raw('(SELECT nome FROM pessoas WHERE id = campanha_pessoa.pessoa_id )'), 'like', '%' . $vl . '%');
        });
        // Se passado dados no SelectBox 'camp_gpo_id' ==> Pesquisa os ID's passados.
        $campanhas->when($request->camp_gpo_id, function ($query, $vl) {
            $query->whereIn('camp_gpo_id', $vl);
        });
        // Se passado dados no SelectBox 'camp_sit_id' ==> Pesquisa os ID's passados.
        $campanhas->when($request->camp_sit_id, function ($query, $vl) {
            $query->whereIn('camp_sit_id', $vl);
        });
        // Se passado dados no SelectBox 'camp_valor' ==> Pesquisa os ID's passados.
        $campanhas->when($request->camp_valor, function ($query, $vl) {
            $query->whereIn('valor', $vl);
        });

        // FILTRO CAMPANHA: Aqui é filtrado para exibir somente itens da Campanha,
        // futuramente, podemos implementar funcionalidade do dízimo.
        $campanhas->where('campanha_id',1);

        // 4) Aplica ordem a Query => realiza o OrderBy.
        // Se acionado alguma coluna de ordenar, realiza o OrderBy.
        $campanhas->when(
            // Ordenar conforme coluna passada.
            $request->field,
            function ($query, $vl) {
                $query->orderBy($vl, request()->direction);
            },
            // Ordenamento padrão: ID ascendente
            function ($query) {
                $query->orderBy('id', 'desc');
            }
        );

        // 5) Executa a Query montada com paginação.
        $campanhas = $campanhas->paginate(10);

        // Define o título da página.
        $titulo = 'Pessoas na Campanha';

        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $camp_gpos = CampGpo::get(['id as value', 'nome as label']);
        $camp_sits = CampSit::get(['id as value', 'nome as label']);

        //$camp_valores = CampSit::get(['id as value', 'nome as label']);
        // Monta os tipos para passar ao ListBox.
        $camp_valores = [
            0 => [
                'value' => '20.00',
                'label' => 'R$20,00',
            ], [
                'value' => '30.00',
                'label' => 'R$30,00',
            ], [
                'value' => '50.00',
                'label' => 'R$50,00',
            ], [
                'value' => '100.00',
                'label' => 'R$100,00',
            ]
        ];

        // Renderiza a View Inertia.
        return Inertia::render('Campanha/GestaoIndex', [
            'titulo' => $titulo,
            'dados' => $campanhas,
            'filters' => $request,
            'camp_gpos' => $camp_gpos,
            'camp_sits' => $camp_sits,
            'camp_valores' => $camp_valores
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
    public function store(StoreCampPessoaPivotRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CampPessoaPivot $campPessoaPivot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampPessoaPivot $campPessoaPivot)
    {
        //dd('edit', $campPessoaPivot);
        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $camp_gpos = CampGpo::get(['id as value', 'nome as label']);
        $camp_sits = CampSit::get(['id as value', 'nome as label']);

        // Carrega o relacionamento
        $campPessoaPivot->load('toPessoa');
        //$campanha = Pessoa::with('campanhas');

        // Define o título da página.
        $titulo = 'Editar Registro de Campanha';

        //dd($campPessoaPivot);

        // Renderiza a View Inertia.
        return Inertia::render('Campanha/GestaoEdit', [
            'titulo' => $titulo,
            'registro' => $campPessoaPivot,
            'camp_gpos' => $camp_gpos,
            'camp_sits' => $camp_sits,
            //'campanha' => $campanha,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampPessoaPivotRequest $request, CampPessoaPivot $campPessoaPivot)
    {
        //dd('update',$request->all());

        // Carrega no model atual os dados aprovados nas validações, para persistir no DB.
        $campPessoaPivot->fill($request->validated());
        // Persiste o model atualizado no DB.
        $campPessoaPivot->save();

        // Redireciona para index.
        return redirect()->route('gestao-campanhas.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampPessoaPivot $campPessoaPivot)
    {
        dd('delete');
    }
}
