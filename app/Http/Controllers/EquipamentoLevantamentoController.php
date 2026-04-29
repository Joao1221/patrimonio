<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevantamentoEquipamentoRequest;
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

class EquipamentoLevantamentoController extends Controller
{
    private const SESSION_CONTEXT_KEY = 'levantamento.contexto';
    private const SESSION_LAST_IDS_KEY = 'levantamento.ultimos_ids';
    private const SESSION_COUNT_KEY = 'levantamento.contador';

    public function index(): View
    {
        $contexto = session(self::SESSION_CONTEXT_KEY, []);
        $contador = session(self::SESSION_COUNT_KEY, 0);
        $ultimosIds = session(self::SESSION_LAST_IDS_KEY, []);

        return view('levantamento.index', [
            'contexto' => $contexto,
            'contador' => $contador,
            'ultimos' => Equipamento::with(['tipoEquipamento', 'setor'])->whereIn('id', $ultimosIds)->latest('id')->limit(10)->get(),
            'tipos' => TipoEquipamento::where('ativo', true)->orderBy('nome')->get(),
            'marcas' => Marca::where('ativo', true)->orderBy('nome')->get(),
            'cidades' => CidadeComarca::where('ativo', true)->orderBy('nome')->get(),
            'varas' => Vara::where('ativo', true)->orderBy('nome')->get(),
            'setores' => Setor::where('ativo', true)->orderBy('nome')->get(),
        ]);
    }

    public function store(StoreLevantamentoEquipamentoRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $equipamento = Equipamento::create($data);

        session([
            self::SESSION_CONTEXT_KEY => [
                'cidade_comarca_id' => $data['cidade_comarca_id'],
                'vara_id' => $data['vara_id'] ?? null,
                'setor_id' => $data['setor_id'] ?? null,
                'tipo_equipamento_id' => $data['tipo_equipamento_id'],
                'marca_id' => $data['marca_id'] ?? null,
                'modelo' => $data['modelo'] ?? null,
            ],
            self::SESSION_COUNT_KEY => (int) session(self::SESSION_COUNT_KEY, 0) + 1,
            self::SESSION_LAST_IDS_KEY => array_values(array_unique(array_slice(array_merge([$equipamento->id], session(self::SESSION_LAST_IDS_KEY, [])), 0, 10))),
        ]);

        if ($request->input('acao') === 'salvar') {
            return redirect()
                ->route('equipamentos.show', $equipamento)
                ->with('success', 'Equipamento cadastrado com sucesso.');
        }

        return redirect()
            ->route('equipamentos.levantamento')
            ->with('success', 'Equipamento cadastrado com sucesso. Leia o proximo equipamento.');
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
}
