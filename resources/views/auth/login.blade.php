@extends('layouts.guest')

@section('title', 'Entrar - Inventário TI')

@section('content')
<main class="min-h-screen bg-slate-950 text-slate-900 lg:grid lg:grid-cols-[1.05fr_0.95fr]">
    <section class="relative hidden overflow-hidden bg-slate-950 px-10 py-10 text-white lg:flex lg:flex-col">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(8,145,178,0.28),transparent_38%),linear-gradient(180deg,rgba(15,23,42,0)_0%,#020617_100%)]"></div>
        <div class="absolute inset-0 opacity-[0.08] [background-image:linear-gradient(rgba(255,255,255,.8)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.8)_1px,transparent_1px)] [background-size:56px_56px]"></div>

        <div class="relative z-10 flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-cyan-500 shadow-lg shadow-cyan-950/40">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Zm2-10h6v6H9V9Z" />
                </svg>
            </div>
            <div>
                <p class="text-lg font-extrabold leading-tight">Inventário TI</p>
                <p class="text-sm text-cyan-200">Controle de Patrimônio</p>
            </div>
        </div>

        <div class="relative z-10 my-auto max-w-2xl">
            <p class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-cyan-200">Acesso restrito</p>
            <h1 class="max-w-xl text-3xl font-black leading-tight tracking-tight xl:text-4xl">
                Gestão de ativos com visão clara e controle seguro.
            </h1>
            <p class="mt-5 max-w-lg text-base leading-7 text-slate-300">
                Centralize equipamentos, localizações, setores e responsáveis em uma rotina de inventário mais organizada.
            </p>

            <div class="mt-10 grid max-w-xl grid-cols-3 gap-3">
                <div class="rounded-lg border border-white/10 bg-white/[0.06] p-4">
                    <p class="text-2xl font-black text-white">TI</p>
                    <p class="mt-1 text-xs font-medium text-slate-300">Equipamentos</p>
                </div>
                <div class="rounded-lg border border-white/10 bg-white/[0.06] p-4">
                    <p class="text-2xl font-black text-white">360</p>
                    <p class="mt-1 text-xs font-medium text-slate-300">Rastreabilidade</p>
                </div>
                <div class="rounded-lg border border-white/10 bg-white/[0.06] p-4">
                    <p class="text-2xl font-black text-white">ADM</p>
                    <p class="mt-1 text-xs font-medium text-slate-300">Permissões</p>
                </div>
            </div>
        </div>

        <div class="relative z-10 overflow-hidden rounded-lg border border-white/10 bg-white/[0.06] p-5 shadow-2xl shadow-black/20">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-white">Painel de inventário</p>
                    <p class="text-xs text-slate-400">Resumo operacional</p>
                </div>
                <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-200">Online</span>
            </div>

            <div class="space-y-3">
                <div class="grid grid-cols-[1fr_88px_72px] gap-3 rounded-md bg-white/[0.07] px-4 py-3 text-sm text-slate-200">
                    <span>Estações de trabalho</span>
                    <span class="text-right text-slate-400">Setor TI</span>
                    <span class="text-right font-bold text-cyan-200">Ativo</span>
                </div>
                <div class="grid grid-cols-[1fr_88px_72px] gap-3 rounded-md bg-white/[0.04] px-4 py-3 text-sm text-slate-300">
                    <span>Nobreaks</span>
                    <span class="text-right text-slate-500">Vara 1</span>
                    <span class="text-right font-bold text-slate-300">Uso</span>
                </div>
                <div class="grid grid-cols-[1fr_88px_72px] gap-3 rounded-md bg-white/[0.04] px-4 py-3 text-sm text-slate-300">
                    <span>Scanners</span>
                    <span class="text-right text-slate-500">Adm.</span>
                    <span class="text-right font-bold text-amber-200">Revisão</span>
                </div>
            </div>
        </div>
    </section>

    <section class="flex min-h-screen items-center justify-center bg-slate-50 px-5 py-2 sm:px-8 lg:min-h-0">
        <div class="w-full max-w-md">
            <div class="mb-8 flex items-center gap-3 lg:hidden">
                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-cyan-600 text-white shadow-lg shadow-cyan-700/20">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Zm2-10h6v6H9V9Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-base font-extrabold leading-tight text-slate-950">Inventário TI</p>
                    <p class="text-xs font-medium text-slate-500">Controle de Patrimônio</p>
                </div>
            </div>

            <div style="width:fit-content; border-radius:5px; overflow:hidden; margin-bottom:-10px; transform:translateZ(0);">
                <img src="{{ asset('logo.png') }}" alt="Logo" style="display:block; height:200px; width:auto;">
            </div>

            <div class="rounded-lg border border-slate-200 bg-white shadow-xl shadow-slate-200/60" style="padding: 24px 32px 32px;">
                <div style="margin-bottom: 12px;">
                    <p class="text-sm font-semibold text-cyan-700">Login</p>
                    <h2 class="mt-2 text-2xl font-black tracking-tight text-slate-950">Acesse sua conta</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Informe suas credenciais para continuar no sistema.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800">
                        <svg class="mt-0.5 h-5 w-5 flex-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                        </svg>
                        <p class="text-sm font-semibold">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">E-mail</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Zm0 0v1.5a2.5 2.5 0 0 0 5 0V12a9 9 0 1 0-9 9m4.5-1.21A8.96 8.96 0 0 1 12 21" />
                            </svg>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="seu@email.com"
                                class="w-full rounded-lg border-slate-200 py-3 pl-11 pr-4 text-sm font-medium text-slate-900 placeholder:text-slate-400 @error('email') border-red-300 bg-red-50 @enderror"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-bold text-slate-700">Senha</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V7a4.5 4.5 0 0 0-9 0v3.5m-.5 0h10a2 2 0 0 1 2 2V19a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6.5a2 2 0 0 1 2-2Z" />
                            </svg>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Digite sua senha"
                                class="w-full rounded-lg border-slate-200 py-3 pl-11 pr-4 text-sm font-medium text-slate-900 placeholder:text-slate-400"
                            >
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <label for="remember" class="flex cursor-pointer select-none items-center gap-3 text-sm font-medium text-slate-600">
                            <input
                                type="checkbox"
                                id="remember"
                                name="remember"
                                class="h-4 w-4 rounded border-slate-300 text-cyan-600 accent-cyan-600"
                            >
                            Lembrar acesso
                        </label>
                    </div>

                    <button type="submit" class="btn-primary w-full py-3 text-base">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H3" />
                        </svg>
                        Entrar
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-xs font-medium text-slate-500">
                Inventário TI &copy; {{ date('Y') }} - Controle de Patrimônio
            </p>
        </div>
    </section>
</main>
@endsection
