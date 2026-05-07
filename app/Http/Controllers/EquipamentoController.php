<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipamentoRequest;
use App\Http\Requests\UpdateEquipamentoRequest;
use App\Models\CidadeComarca;
use App\Models\Equipamento;
use App\Models\Marca;
use App\Models\Setor;
use App\Models\TipoEquipamento;
use App\Models\Vara;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{
    public function index(Request $request): View
    {
        $cidadeRestrita = auth()->user()->cidade_comarca_id;

        $query = Equipamento::query()
            ->with(['tipoEquipamento', 'marca', 'cidadeComarca', 'vara', 'setor'])
            ->when($cidadeRestrita, fn($q) => $q->where('cidade_comarca_id', $cidadeRestrita))
            ->orderByRaw('(SELECT nome FROM cidades_comarcas WHERE id = equipamentos.cidade_comarca_id)')
            ->orderByRaw('(SELECT nome FROM tipos_equipamento WHERE id = equipamentos.tipo_equipamento_id)')
            ->orderByRaw('(SELECT nome FROM setores WHERE id = equipamentos.setor_id)')
            ->orderByRaw('(SELECT nome FROM marcas WHERE id = equipamentos.marca_id)');

        if ($request->filled('codigo_patrimonio')) {
            $query->where('codigo_patrimonio', 'like', '%' . $request->string('codigo_patrimonio') . '%');
        }

        foreach (['tipo_equipamento_id', 'marca_id', 'setor_id'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->integer($filter));
            }
        }

        // cidade só filtra se o usuário tiver acesso livre
        if (!$cidadeRestrita && $request->filled('cidade_comarca_id')) {
            $query->where('cidade_comarca_id', $request->integer('cidade_comarca_id'));
        }

        // vara
        if ($request->filled('vara_id')) {
            $query->where('vara_id', $request->integer('vara_id'));
        }

        $equipamentos = $query->paginate(20)->withQueryString();

        // Para os cards de stats, cidade restrita tem prioridade
        $cidadeIdStats = $cidadeRestrita
            ?? ($request->filled('cidade_comarca_id') ? $request->integer('cidade_comarca_id') : null);
        $varaId = $request->filled('vara_id') ? $request->integer('vara_id') : null;

        $totalEquipamentos = Equipamento::query()
            ->when($varaId,                           fn($q) => $q->where('vara_id', $varaId))
            ->when(!$varaId && $cidadeIdStats,        fn($q) => $q->where('cidade_comarca_id', $cidadeIdStats))
            ->count();

        $totaisPorTipo = TipoEquipamento::withCount(['equipamentos' => function ($q) use ($cidadeIdStats, $varaId) {
            if ($varaId) {
                $q->where('vara_id', $varaId);
            } elseif ($cidadeIdStats) {
                $q->where('cidade_comarca_id', $cidadeIdStats);
            }
        }])->orderBy('nome')->get();

        return view('equipamentos.index', [
            'equipamentos'      => $equipamentos,
            'tipos'             => TipoEquipamento::where('ativo', true)->orderBy('nome')->get(),
            'marcas'            => Marca::where('ativo', true)->orderBy('nome')->get(),
            'cidades'           => $this->cidadesPermitidas(),
            'varas'             => Vara::where('ativo', true)->orderBy('nome')->get(),
            'setores'           => Setor::where('ativo', true)->orderBy('nome')->get(),
            'filters'           => $request->all(),
            'totalEquipamentos' => $totalEquipamentos,
            'totaisPorTipo'     => $totaisPorTipo,
            'cidadeRestrita'    => $cidadeRestrita,
        ]);
    }

    public function create(Request $request): View
    {
        return view('equipamentos.create', $this->formData([
            'codigo_patrimonio' => $request->query('codigo_patrimonio'),
        ]));
    }

    public function store(StoreEquipamentoRequest $request): RedirectResponse
    {
        $equipamento = Equipamento::create($request->validated());

        return redirect()
            ->route('equipamentos.show', $equipamento)
            ->with('success', 'Equipamento cadastrado com sucesso.');
    }

    public function show(Equipamento $equipamento): View
    {
        return view('equipamentos.show', [
            'equipamento' => $equipamento->load(['tipoEquipamento', 'marca', 'cidadeComarca', 'vara', 'setor']),
        ]);
    }

    public function edit(Equipamento $equipamento): View
    {
        return view('equipamentos.edit', $this->formData([
            'equipamento' => $equipamento->load(['tipoEquipamento', 'marca', 'cidadeComarca', 'vara', 'setor']),
        ]));
    }

    public function update(UpdateEquipamentoRequest $request, Equipamento $equipamento): RedirectResponse
    {
        $equipamento->update($request->validated());

        return redirect()
            ->route('equipamentos.show', $equipamento)
            ->with('success', 'Equipamento atualizado com sucesso.');
    }

    public function destroy(Equipamento $equipamento): RedirectResponse
    {
        $equipamento->delete();

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento excluído com sucesso.');
    }

    public function stats(Request $request): JsonResponse
    {
        $cidadeRestrita = auth()->user()?->cidade_comarca_id;

        $cidadeId = $cidadeRestrita
            ?? ($request->filled('cidade_comarca_id') ? $request->integer('cidade_comarca_id') : null);
        $varaId = $request->filled('vara_id') ? $request->integer('vara_id') : null;

        $total = Equipamento::query()
            ->when($varaId,                    fn($q) => $q->where('vara_id', $varaId))
            ->when(!$varaId && $cidadeId,      fn($q) => $q->where('cidade_comarca_id', $cidadeId))
            ->count();

        $porTipo = TipoEquipamento::withCount(['equipamentos' => function ($q) use ($cidadeId, $varaId) {
            if ($varaId) {
                $q->where('vara_id', $varaId);
            } elseif ($cidadeId) {
                $q->where('cidade_comarca_id', $cidadeId);
            }
        }])->orderBy('nome')->get()->map(fn($t) => [
            'nome'  => $t->nome,
            'count' => $t->equipamentos_count,
        ]);

        return response()->json(['total' => $total, 'porTipo' => $porTipo]);
    }

    public function buscarPorCodigo(string $codigo): JsonResponse
    {
        $equipamento = Equipamento::with(['tipoEquipamento', 'marca', 'cidadeComarca', 'vara', 'setor'])
            ->where('codigo_patrimonio', $codigo)
            ->first();

        if (! $equipamento) {
            return response()->json(['message' => 'Equipamento nao encontrado.'], 404);
        }

        return response()->json($equipamento);
    }

    public function verificarCodigo(string $codigo): JsonResponse
    {
        $equipamento = Equipamento::with(['tipoEquipamento', 'cidadeComarca', 'vara', 'setor'])
            ->where('codigo_patrimonio', $codigo)
            ->first();

        return response()->json([
            'exists'      => (bool) $equipamento,
            'equipamento' => $equipamento,
        ]);
    }

    private function cidadesPermitidas()
    {
        $cidadeId = auth()->user()->cidade_comarca_id;

        return CidadeComarca::where('ativo', true)
            ->when($cidadeId, fn($q) => $q->where('id', $cidadeId))
            ->orderBy('nome')
            ->get();
    }

    private function formData(array $extra = []): array
    {
        return array_merge([
            'tipos'          => TipoEquipamento::where('ativo', true)->orderBy('nome')->get(),
            'marcas'         => Marca::where('ativo', true)->orderBy('nome')->get(),
            'cidades'        => $this->cidadesPermitidas(),
            'varas'          => Vara::where('ativo', true)->orderBy('nome')->get(),
            'setores'        => Setor::where('ativo', true)->orderBy('nome')->get(),
            'cidadeRestrita' => auth()->user()->cidade_comarca_id,
        ], $extra);
    }
}
