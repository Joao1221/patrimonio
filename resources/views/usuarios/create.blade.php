@extends('layouts.app')

@section('title', 'Novo Usuário')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Novo usuário</h1>
            <p class="text-slate-500 text-sm mt-1">Cadastre um novo acesso ao sistema</p>
        </div>
        <a href="{{ route('usuarios.index') }}" class="btn-muted">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Voltar
        </a>
    </div>

    <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-6">
        @csrf

        {{-- Dados pessoais --}}
        <div class="panel p-6">
            <h2 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-5 pb-3 border-b border-slate-100">
                Dados do usuário
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Nome completo <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required maxlength="255"
                        class="w-full @error('name') border-red-400 bg-red-50 @enderror"
                        placeholder="Nome do usuário">
                    @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">E-mail <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required maxlength="255"
                        class="w-full @error('email') border-red-400 bg-red-50 @enderror"
                        placeholder="email@exemplo.com">
                    @error('email')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Senha <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required minlength="8"
                        class="w-full @error('password') border-red-400 bg-red-50 @enderror"
                        placeholder="Mínimo 8 caracteres">
                    @error('password')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Confirmar senha <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" required minlength="8"
                        class="w-full"
                        placeholder="Repita a senha">
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
                    <select name="papel" required id="select-papel"
                        class="w-full @error('papel') border-red-400 bg-red-50 @enderror">
                        <option value="">Selecione o perfil</option>
                        @foreach ($papeis as $papel)
                            <option value="{{ $papel->value }}" @selected(old('papel') === $papel->value)>
                                {{ $papel->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('papel')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    <div id="papel-hint" class="hidden text-xs text-slate-500 mt-1 p-2 rounded-lg bg-slate-50 border border-slate-200"></div>
                </div>

                {{-- Cidade/Comarca --}}
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Acesso por cidade/comarca</label>
                    <select name="cidade_comarca_id" id="select-cidade"
                        class="w-full @error('cidade_comarca_id') border-red-400 bg-red-50 @enderror">
                        <option value="">— Todas as cidades —</option>
                        @foreach ($cidades as $cidade)
                            <option value="{{ $cidade->id }}" @selected(old('cidade_comarca_id') == $cidade->id)>
                                {{ $cidade->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('cidade_comarca_id')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    <p class="text-xs text-slate-500 mt-1">
                        Selecione uma cidade para restringir o acesso, ou deixe em branco para liberar todas.
                    </p>
                </div>
            </div>

            {{-- Cards descritivos dos perfis --}}
            <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">Master</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Acesso total ao sistema: CRUD de equipamentos, tabelas auxiliares e gestão de usuários.</p>
                </div>
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800 border border-cyan-200">Administrador</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Cadastra e edita equipamentos e tabelas auxiliares. Não gerencia outros usuários.</p>
                </div>
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-300">Usuário</span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">Apenas consulta e visualização. Pode imprimir relatórios, mas não altera nenhum dado.</p>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Criar usuário
            </button>
            <a href="{{ route('usuarios.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
