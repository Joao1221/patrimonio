<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaraRequest;
use App\Models\CidadeComarca;
use App\Models\Vara;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VaraController extends Controller
{
    public function index(): View
    {
        return view('auxiliares.index', [
            'titulo' => 'Varas',
            'rota' => 'varas',
            'campoCidade' => true,
            'itens' => Vara::with('cidadeComarca')->orderByRaw('(SELECT nome FROM cidades_comarcas WHERE id = varas.cidade_comarca_id)')->orderBy('nome')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('auxiliares.create', [
            'titulo' => 'Nova vara',
            'tituloSingular' => 'Vara',
            'rota' => 'varas',
            'campoCidade' => true,
            'cidades' => CidadeComarca::where('ativo', true)->orderBy('nome')->get(),
        ]);
    }

    public function store(StoreVaraRequest $request): RedirectResponse
    {
        Vara::create($request->validated());

        return redirect()->route('varas.index')->with('success', 'Vara criada com sucesso.');
    }

    public function show(Vara $vara): View
    {
        return view('auxiliares.show', [
            'titulo' => 'Vara',
            'tituloSingular' => 'Vara',
            'rota' => 'varas',
            'item' => $vara->load('cidadeComarca'),
            'campoCidade' => true,
        ]);
    }

    public function edit(Vara $vara): View
    {
        return view('auxiliares.edit', [
            'titulo' => 'Editar vara',
            'tituloSingular' => 'Vara',
            'rota' => 'varas',
            'item' => $vara->load('cidadeComarca'),
            'campoCidade' => true,
            'cidades' => CidadeComarca::where('ativo', true)->orderBy('nome')->get(),
        ]);
    }

    public function update(Request $request, Vara $vara): RedirectResponse
    {
        $data = $request->validate([
            'cidade_comarca_id' => ['required', 'exists:cidades_comarcas,id'],
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('varas', 'nome')
                    ->where(fn ($query) => $query->where('cidade_comarca_id', $request->input('cidade_comarca_id')))
                    ->ignore($vara->id),
            ],
            'ativo' => ['sometimes', 'boolean'],
        ]);

        $vara->update($data);

        return redirect()->route('varas.index')->with('success', 'Vara atualizada com sucesso.');
    }

    public function destroy(Vara $vara): RedirectResponse
    {
        $vara->update(['ativo' => false]);

        return redirect()->route('varas.index')->with('success', 'Vara desativada com sucesso.');
    }
}
