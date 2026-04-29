<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoEquipamentoRequest;
use App\Models\TipoEquipamento;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TipoEquipamentoController extends Controller
{
    public function index(): View
    {
        return view('auxiliares.index', [
            'titulo' => 'Tipos de equipamento',
            'rota' => 'tipos-equipamento',
            'campoCidade' => false,
            'itens' => TipoEquipamento::orderBy('nome')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('auxiliares.create', ['titulo' => 'Novo tipo de equipamento', 'rota' => 'tipos-equipamento', 'campoCidade' => false]);
    }

    public function store(StoreTipoEquipamentoRequest $request): RedirectResponse
    {
        TipoEquipamento::create($request->validated());

        return redirect()->route('tipos-equipamento.index')->with('success', 'Tipo criado com sucesso.');
    }

    public function show(TipoEquipamento $tipos_equipamento): View
    {
        return view('auxiliares.show', ['titulo' => 'Tipo de equipamento', 'rota' => 'tipos-equipamento', 'item' => $tipos_equipamento, 'campoCidade' => false]);
    }

    public function edit(TipoEquipamento $tipos_equipamento): View
    {
        return view('auxiliares.edit', ['titulo' => 'Editar tipo de equipamento', 'rota' => 'tipos-equipamento', 'item' => $tipos_equipamento, 'campoCidade' => false]);
    }

    public function update(Request $request, TipoEquipamento $tipos_equipamento): RedirectResponse
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255', Rule::unique('tipos_equipamento', 'nome')->ignore($tipos_equipamento->id)],
            'ativo' => ['sometimes', 'boolean'],
        ]);

        $tipos_equipamento->update($data);

        return redirect()->route('tipos-equipamento.index')->with('success', 'Tipo atualizado com sucesso.');
    }

    public function destroy(TipoEquipamento $tipos_equipamento): RedirectResponse
    {
        $tipos_equipamento->update(['ativo' => false]);

        return redirect()->route('tipos-equipamento.index')->with('success', 'Tipo desativado com sucesso.');
    }
}
