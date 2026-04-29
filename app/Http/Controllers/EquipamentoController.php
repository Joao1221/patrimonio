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
        $query = Equipamento::query()->with(['tipoEquipamento', 'marca', 'cidadeComarca', 'vara', 'setor']);

        if ($request->filled('codigo_patrimonio')) {
            $query->where('codigo_patrimonio', 'like', '%' . $request->string('codigo_patrimonio') . '%');
        }

        foreach (['tipo_equipamento_id', 'marca_id', 'cidade_comarca_id', 'vara_id', 'setor_id'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->integer($filter));
            }
        }

        $equipamentos = $query->latest()->paginate(20)->withQueryString();

        return view('equipamentos.index', [
            'equipamentos' => $equipamentos,
            'tipos' => TipoEquipamento::where('ativo', true)->orderBy('nome')->get(),
            'marcas' => Marca::where('ativo', true)->orderBy('nome')->get(),
            'cidades' => CidadeComarca::where('ativo', true)->orderBy('nome')->get(),
            'varas' => Vara::where('ativo', true)->orderBy('nome')->get(),
            'setores' => Setor::where('ativo', true)->orderBy('nome')->get(),
            'filters' => $request->all(),
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
        return redirect()
            ->route('equipamentos.index')
            ->with('error', 'Exclusao desabilitada para equipamentos. Utilize edicao para ajustes.');
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
            'exists' => (bool) $equipamento,
            'equipamento' => $equipamento,
        ]);
    }

    private function formData(array $extra = []): array
    {
        return array_merge([
            'tipos' => TipoEquipamento::where('ativo', true)->orderBy('nome')->get(),
            'marcas' => Marca::where('ativo', true)->orderBy('nome')->get(),
            'cidades' => CidadeComarca::where('ativo', true)->orderBy('nome')->get(),
            'varas' => Vara::where('ativo', true)->orderBy('nome')->get(),
            'setores' => Setor::where('ativo', true)->orderBy('nome')->get(),
        ], $extra);
    }
}
