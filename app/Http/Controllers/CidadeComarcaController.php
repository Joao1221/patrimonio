<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCidadeComarcaRequest;
use App\Models\CidadeComarca;
use App\Models\Vara;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CidadeComarcaController extends Controller
{
    public function index(): View
    {
        return view('auxiliares.index', [
            'titulo' => 'Cidades/Comarcas',
            'rota' => 'cidades-comarcas',
            'campoCidade' => false,
            'itens' => CidadeComarca::orderBy('nome')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('auxiliares.create', ['titulo' => 'Nova cidade/comarca', 'tituloSingular' => 'Cidade/Comarca', 'rota' => 'cidades-comarcas', 'campoCidade' => false]);
    }

    public function store(StoreCidadeComarcaRequest $request): RedirectResponse
    {
        CidadeComarca::create($request->validated());

        return redirect()->route('cidades-comarcas.index')->with('success', 'Cidade/comarca criada com sucesso.');
    }

    public function show(CidadeComarca $cidades_comarca): View
    {
        return view('auxiliares.show', ['titulo' => 'Cidade/Comarca', 'tituloSingular' => 'Cidade/Comarca', 'rota' => 'cidades-comarcas', 'item' => $cidades_comarca, 'campoCidade' => false]);
    }

    public function edit(CidadeComarca $cidades_comarca): View
    {
        return view('auxiliares.edit', ['titulo' => 'Editar cidade/comarca', 'tituloSingular' => 'Cidade/Comarca', 'rota' => 'cidades-comarcas', 'item' => $cidades_comarca, 'campoCidade' => false]);
    }

    public function update(Request $request, CidadeComarca $cidades_comarca): RedirectResponse
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255', Rule::unique('cidades_comarcas', 'nome')->ignore($cidades_comarca->id)],
            'ativo' => ['sometimes', 'boolean'],
        ]);

        $cidades_comarca->update($data);

        return redirect()->route('cidades-comarcas.index')->with('success', 'Cidade/comarca atualizada com sucesso.');
    }

    public function destroy(CidadeComarca $cidades_comarca): RedirectResponse
    {
        $cidades_comarca->update(['ativo' => false]);

        return redirect()->route('cidades-comarcas.index')->with('success', 'Cidade/comarca desativada com sucesso.');
    }

    public function varas(int $id): JsonResponse
    {
        $varas = Vara::query()
            ->where('cidade_comarca_id', $id)
            ->where('ativo', true)
            ->orderBy('nome')
            ->get();

        return response()->json($varas);
    }
}
