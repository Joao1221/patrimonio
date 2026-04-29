<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaRequest;
use App\Models\Marca;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarcaController extends Controller
{
    public function index(): View
    {
        return view('auxiliares.index', [
            'titulo' => 'Marcas',
            'rota' => 'marcas',
            'campoCidade' => false,
            'itens' => Marca::orderBy('nome')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('auxiliares.create', ['titulo' => 'Nova marca', 'rota' => 'marcas', 'campoCidade' => false]);
    }

    public function store(StoreMarcaRequest $request): RedirectResponse
    {
        Marca::create($request->validated());

        return redirect()->route('marcas.index')->with('success', 'Marca criada com sucesso.');
    }

    public function show(Marca $marca): View
    {
        return view('auxiliares.show', ['titulo' => 'Marca', 'rota' => 'marcas', 'item' => $marca, 'campoCidade' => false]);
    }

    public function edit(Marca $marca): View
    {
        return view('auxiliares.edit', ['titulo' => 'Editar marca', 'rota' => 'marcas', 'item' => $marca, 'campoCidade' => false]);
    }

    public function update(Request $request, Marca $marca): RedirectResponse
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255', Rule::unique('marcas', 'nome')->ignore($marca->id)],
            'ativo' => ['sometimes', 'boolean'],
        ]);

        $marca->update($data);

        return redirect()->route('marcas.index')->with('success', 'Marca atualizada com sucesso.');
    }

    public function destroy(Marca $marca): RedirectResponse
    {
        $marca->update(['ativo' => false]);

        return redirect()->route('marcas.index')->with('success', 'Marca desativada com sucesso.');
    }
}
