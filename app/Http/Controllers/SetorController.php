<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSetorRequest;
use App\Models\Setor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SetorController extends Controller
{
    public function index(): View
    {
        return view('auxiliares.index', [
            'titulo' => 'Setores',
            'rota' => 'setores',
            'campoCidade' => false,
            'itens' => Setor::orderBy('nome')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('auxiliares.create', ['titulo' => 'Novo setor', 'rota' => 'setores', 'campoCidade' => false]);
    }

    public function store(StoreSetorRequest $request): RedirectResponse
    {
        Setor::create($request->validated());

        return redirect()->route('setores.index')->with('success', 'Setor criado com sucesso.');
    }

    public function show(Setor $setore): View
    {
        return view('auxiliares.show', ['titulo' => 'Setor', 'rota' => 'setores', 'item' => $setore, 'campoCidade' => false]);
    }

    public function edit(Setor $setore): View
    {
        return view('auxiliares.edit', ['titulo' => 'Editar setor', 'rota' => 'setores', 'item' => $setore, 'campoCidade' => false]);
    }

    public function update(Request $request, Setor $setore): RedirectResponse
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255', Rule::unique('setores', 'nome')->ignore($setore->id)],
            'ativo' => ['sometimes', 'boolean'],
        ]);

        $setore->update($data);

        return redirect()->route('setores.index')->with('success', 'Setor atualizado com sucesso.');
    }

    public function destroy(Setor $setore): RedirectResponse
    {
        $setore->update(['ativo' => false]);

        return redirect()->route('setores.index')->with('success', 'Setor desativado com sucesso.');
    }
}
