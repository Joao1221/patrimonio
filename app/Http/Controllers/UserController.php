<?php

namespace App\Http\Controllers;

use App\Enums\PapelUsuario;
use App\Models\CidadeComarca;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $usuarios = User::with('cidadeComarca')->orderBy('name')->paginate(20);

        return view('usuarios.index', compact('usuarios'));
    }

    public function create(): View
    {
        return view('usuarios.create', [
            'papeis'  => PapelUsuario::cases(),
            'cidades' => CidadeComarca::where('ativo', true)->orderBy('nome')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'papel'             => ['required', Rule::enum(PapelUsuario::class)],
            'cidade_comarca_id' => ['nullable', 'exists:cidades_comarcas,id'],
        ]);

        // Checkbox "todas" desmarcado envia string vazia; converter para null
        $data['cidade_comarca_id'] = $data['cidade_comarca_id'] ?: null;

        User::create($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(User $usuario): View
    {
        return view('usuarios.edit', [
            'usuario' => $usuario,
            'papeis'  => PapelUsuario::cases(),
            'cidades' => CidadeComarca::where('ativo', true)->orderBy('nome')->get(),
        ]);
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        $isSelf = $usuario->id === auth()->id();

        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'password'          => ['nullable', 'string', 'min:8', 'confirmed'],
            'papel'             => ['required', Rule::enum(PapelUsuario::class)],
            'ativo'             => ['sometimes', 'boolean'],
            'cidade_comarca_id' => ['nullable', 'exists:cidades_comarcas,id'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $data['cidade_comarca_id'] = $data['cidade_comarca_id'] ?: null;

        if ($isSelf) {
            unset($data['papel'], $data['ativo']);
        } else {
            $data['ativo'] = $request->boolean('ativo');
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $usuario): RedirectResponse
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'Você não pode excluir sua própria conta.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuário removido com sucesso.');
    }
}
