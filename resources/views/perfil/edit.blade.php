@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<div class="mx-auto max-w-6xl space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-cyan-700">Conta</p>
            <h1 class="mt-1 text-2xl font-black tracking-tight text-slate-950">Meu perfil</h1>
            <p class="mt-1 text-sm text-slate-500">Atualize seus dados pessoais e a senha de acesso.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-muted self-start sm:self-auto">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19 3 12m0 0 7-7m-7 7h18" />
            </svg>
            Voltar ao painel
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[360px_1fr]">
        <aside class="space-y-6">
            <div class="panel overflow-hidden">
                <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-950 px-6 py-7 text-white">
                    <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-cyan-500 text-2xl font-black shadow-lg shadow-cyan-950/40">
                        {{ mb_strtoupper(mb_substr($usuario->name, 0, 1)) }}
                    </div>
                    <h2 class="mt-5 text-xl font-black leading-tight">{{ $usuario->name }}</h2>
                    <p class="mt-1 break-all text-sm text-slate-300">{{ $usuario->email }}</p>
                </div>

                <div class="space-y-4 p-6">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Perfil de acesso</p>
                        <span class="mt-2 inline-flex items-center rounded-full border px-3 py-1 text-xs font-bold {{ $usuario->papel->badgeClass() }}">
                            {{ $usuario->papel->label() }}
                        </span>
                    </div>

                    <div class="border-t border-slate-100 pt-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Abrang&ecirc;ncia</p>
                        @if($usuario->verTodasCidades())
                            <p class="mt-2 text-sm font-semibold text-slate-800">Todas as cidades/comarcas</p>
                        @else
                            <div class="mt-2 flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-700">
                                <svg class="h-4 w-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.14-7.5 11.25-7.5 11.25S4.5 17.64 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                {{ $usuario->cidadeComarca?->nome }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-cyan-200 bg-cyan-50 p-5">
                <div class="flex gap-3">
                    <div class="flex h-9 w-9 flex-none items-center justify-center rounded-lg bg-cyan-100 text-cyan-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V7a4.5 4.5 0 0 0-9 0v3.5m-.5 0h10a2 2 0 0 1 2 2V19a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6.5a2 2 0 0 1 2-2Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-cyan-950">Confirma&ccedil;&atilde;o obrigat&oacute;ria</h3>
                        <p class="mt-1 text-sm leading-6 text-cyan-800">Para salvar qualquer altera&ccedil;&atilde;o, informe sua senha atual.</p>
                    </div>
                </div>
            </div>
        </aside>

        <form method="POST" action="{{ route('perfil.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <section class="panel p-6">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h2 class="text-sm font-black uppercase tracking-wider text-slate-700">Dados pessoais</h2>
                    <p class="mt-1 text-sm text-slate-500">Essas informa&ccedil;&otilde;es aparecem na navega&ccedil;&atilde;o e nos registros do sistema.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="space-y-1.5">
                        <label for="name" class="block text-sm font-bold text-slate-700">Nome completo <span class="text-red-500">*</span></label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name', $usuario->name) }}"
                            required
                            maxlength="255"
                            class="w-full @error('name') border-red-400 bg-red-50 @enderror"
                        >
                        @error('name')<p class="text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="block text-sm font-bold text-slate-700">E-mail <span class="text-red-500">*</span></label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $usuario->email) }}"
                            required
                            maxlength="255"
                            class="w-full @error('email') border-red-400 bg-red-50 @enderror"
                        >
                        @error('email')<p class="text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section class="panel p-6">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h2 class="text-sm font-black uppercase tracking-wider text-slate-700">Seguran&ccedil;a</h2>
                    <p class="mt-1 text-sm text-slate-500">Deixe a nova senha em branco caso queira manter a senha atual.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="space-y-1.5 md:col-span-2">
                        <label for="senha_atual" class="block text-sm font-bold text-slate-700">Senha atual <span class="text-red-500">*</span></label>
                        <div class="relative max-w-md">
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V7a4.5 4.5 0 0 0-9 0v3.5m-.5 0h10a2 2 0 0 1 2 2V19a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6.5a2 2 0 0 1 2-2Z" />
                            </svg>
                            <input
                                id="senha_atual"
                                type="password"
                                name="senha_atual"
                                required
                                placeholder="Informe sua senha atual"
                                class="w-full pl-11 @error('senha_atual') border-red-400 bg-red-50 @enderror"
                            >
                        </div>
                        @error('senha_atual')<p class="text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="password" class="block text-sm font-bold text-slate-700">
                            Nova senha
                            <span class="ml-1 text-xs font-medium text-slate-400">(opcional)</span>
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            minlength="8"
                            placeholder="M&iacute;nimo 8 caracteres"
                            class="w-full @error('password') border-red-400 bg-red-50 @enderror"
                        >
                        @error('password')<p class="text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-700">Confirmar nova senha</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            minlength="8"
                            placeholder="Repita a nova senha"
                            class="w-full"
                        >
                    </div>
                </div>
            </section>

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('dashboard') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Salvar altera&ccedil;&otilde;es
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
