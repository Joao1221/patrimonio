@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Editar usuário</h1>
            <p class="text-slate-500 text-sm mt-1">{{ $usuario->name }}</p>
        </div>
        <a href="{{ route('usuarios.index') }}" class="btn-muted">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Voltar
        </a>
    </div>

    <form method="POST" action="{{ route('usuarios.update', $usuario) }}" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Dados pessoais --}}
        <div class="panel p-6">
            <h2 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-5 pb-3 border-b border-slate-100">
                Dados do usuário
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Nome completo <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required maxlength="255"
                        class="w-full @error('name') border-red-400 bg-red-50 @enderror">
                    @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">E-mail <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required maxlength="255"
                        class="w-full @error('email') border-red-400 bg-red-50 @enderror">
                    @error('email')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">
                        Nova senha
                        <span class="text-slate-400 font-normal text-xs ml-1">(deixe em branco para manter)</span>
                    </label>
                    <input type="password" name="password" minlength="8"
                        class="w-full @error('password') border-red-400 bg-red-50 @enderror"
                        placeholder="Mínimo 8 caracteres">
                    @error('password')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Confirmar nova senha</label>
                    <input type="password" name="password_confirmation" minlength="8"
                        class="w-full"
                        placeholder="Repita a nova senha">
                </div>
            </div>
        </div>

        {{-- Perfil e acesso --}}
        <div class="panel p-6">
            <h2 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-5 pb-3 border-b border-slate-100">
                Perfil e acesso
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Perfil --}}
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Perfil de acesso <span class="text-red-500">*</span></label>
                    @if($usuario->id === auth()->id())
                        <input type="hidden" name="papel" value="{{ $usuario->papel->value }}">
                        <input type="text" value="{{ $usuario->papel->label() }}" disabled
                            class="w-full bg-slate-50 text-slate-500 cursor-not-allowed">
                        <p class="text-xs text-slate-400 mt-1">Você não pode alterar o próprio perfil.</p>
                    @else
                        <select name="papel" required class="w-full @error('papel') border-red-400 bg-red-50 @enderror">
                            @foreach ($papeis as $papel)
                                <option value="{{ $papel->value }}" @selected(old('papel', $usuario->papel->value) === $papel->value)>
                                    {{ $papel->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('papel')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    @endif
                </div>

                {{-- Cidade/Comarca --}}
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Acesso por cidade/comarca</label>
                    <select name="cidade_comarca_id"
                        class="w-full @error('cidade_comarca_id') border-red-400 bg-red-50 @enderror">
                        <option value="">— Todas as cidades —</option>
                        @foreach ($cidades as $cidade)
                            <option value="{{ $cidade->id }}"
                                @selected(old('cidade_comarca_id', $usuario->cidade_comarca_id) == $cidade->id)>
                                {{ $cidade->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('cidade_comarca_id')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    <p class="text-xs text-slate-500 mt-1">
                        Selecione uma cidade para restringir o acesso, ou deixe em branco para liberar todas.
                    </p>
                </div>

                {{-- Status (não editável para si mesmo) --}}
                @if($usuario->id !== auth()->id())
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Status da conta</label>
                    <div class="flex items-center gap-3 h-[42px]">
                        <input type="checkbox" id="ativo" name="ativo" value="1"
                            @checked(old('ativo', $usuario->ativo))
                            class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500 w-4 h-4 cursor-pointer">
                        <label for="ativo" class="text-sm text-slate-700 cursor-pointer">Conta ativa</label>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Zona de risco: remover usuário --}}
        @if($usuario->id !== auth()->id())
        <div class="panel p-5 border-red-200 bg-red-50/50">
            <h3 class="text-sm font-semibold text-red-800 mb-3">Zona de risco</h3>
            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="inline"
                    onsubmit="return confirm('Tem certeza que deseja remover permanentemente este usuário?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-red-600 text-white hover:bg-red-700 shadow-lg shadow-red-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Remover usuário
                    </button>
                </form>
                <span class="text-sm text-red-600">Esta ação é irreversível e remove o usuário do sistema.</span>
            </div>
        </div>
        @endif

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Salvar alterações
            </button>
            <a href="{{ route('usuarios.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
