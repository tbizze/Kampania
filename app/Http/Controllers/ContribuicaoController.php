<?php

namespace App\Http\Controllers;

use App\Models\Contribuicao;
use App\Http\Requests\StoreContribuicaoRequest;
use App\Http\Requests\UpdateContribuicaoRequest;
use App\Models\CampPessoaPivot;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContribuicaoController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('can:gestao_campanhas.index')->only('index');
        $this->middleware('can:gestao_campanhas.create')->only('create', 'store');
        $this->middleware('can:gestao_campanhas.edit')->only('edit',);
        $this->middleware('can:gestao_campanhas.destroy')->only('destroy'); */        
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $campanhas = Contribuicao::with(['toConta', 'toOperacaoTp'])
            ->addSelect([
                // alias da sub-select
                'pessoa_id' => CampPessoaPivot::query()
                    // You can use eloquent methods here
                    ->select('pessoa_id')
                    ->whereColumn('pessoa_id', 'campanha_pessoa_id')
                    ->latest()
                    ->take(1),
                // alias da sub-select
                'pessoa_nome' => Pessoa::query()
                    // You can use eloquent methods here
                    ->select('nome')
                    ->whereColumn('id', 'pessoa_id')
                    ->latest()
                    ->take(1),
            ]);
        
        //dd ($campanhas);
        //dd ($campanhas->get()->toArray());
        
        // 5) Executa a Query montada com paginação.
        $campanhas = $campanhas->paginate(10);

        // Define o título da página.
        $titulo = 'Pessoas na Campanha';

        // Renderiza a View Inertia.
        return Inertia::render('Contribuicao/ContribIndex', [
            'titulo' => $titulo,
            'dados' => $campanhas,
            'filters' => $request,
            /* 'camp_gpos' => $camp_gpos,
            'camp_sits' => $camp_sits,
            'camp_valores' => $camp_valores  */
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContribuicaoRequest $request)
    {
        //
        dd('store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contribuicao $contribuicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contribuicao $contribuicao)
    {
        //
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContribuicaoRequest $request, Contribuicao $contribuicao)
    {
        //
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contribuicao $contribuicao)
    {
        //
        dd('destroy');
    }
}
