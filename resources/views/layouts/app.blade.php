<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f172a">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>@yield('title', 'Controle de Patrimônio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-slate-900 font-sans">
    <header class="sticky top-0 z-40 backdrop-blur-xl bg-slate-950/85 border-b border-slate-800/50 shadow-lg shadow-black/20">
        <div class="mx-auto max-w-7xl px-4 py-3">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                    <div class="p-2 rounded-xl bg-gradient-to-br from-cyan-400 to-cyan-600 shadow-lg shadow-cyan-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-extrabold tracking-tight text-white group-hover:text-cyan-300 transition-colors">Inventário TI</span>
                </a>
                <nav class="hidden md:flex items-center gap-1">
                    <a class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-200" href="{{ route('equipamentos.index') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Equipamentos
                    </a>
                    <a class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-200" href="{{ route('equipamentos.levantamento') }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Levantamento
                    </a>
                    <div class="w-px h-6 bg-slate-700 mx-2"></div>
                    <a class="px-3 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-white/5 transition" href="{{ route('tipos-equipamento.index') }}">Tipos</a>
                    <a class="px-3 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-white/5 transition" href="{{ route('marcas.index') }}">Marcas</a>
                    <a class="px-3 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-white/5 transition" href="{{ route('cidades-comarcas.index') }}">Cidades</a>
                    <a class="px-3 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-white/5 transition" href="{{ route('varas.index') }}">Varas</a>
                    <a class="px-3 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-white/5 transition" href="{{ route('setores.index') }}">Setores</a>
                    @if(auth()->user()?->canManageUsers())
                    <div class="w-px h-6 bg-slate-700 mx-2"></div>
                    <a class="px-3 py-2 rounded-lg text-xs font-medium text-amber-400 hover:text-amber-200 hover:bg-white/5 transition" href="{{ route('usuarios.index') }}">Usuários</a>
                    @endif
                    <div class="w-px h-6 bg-slate-700 mx-2"></div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('perfil.edit') }}" class="text-right group" title="Meu perfil">
                            <p class="text-xs font-semibold text-white leading-tight group-hover:text-cyan-300 transition-colors">{{ auth()->user()?->name }}</p>
                            <span class="text-xs px-1.5 py-0.5 rounded font-medium {{ auth()->user()?->papel?->badgeClass() }}">
                                {{ auth()->user()?->papel?->label() }}
                            </span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" title="Sair" class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-white/10 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </button>
                        </form>
                    </div>
                </nav>
                <button id="mobile-menu-button" type="button" aria-expanded="false" aria-controls="mobile-menu" class="md:hidden p-2 text-slate-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
            <nav id="mobile-menu" class="hidden md:hidden mt-3 pt-3 border-t border-slate-800/70">
                <div class="grid grid-cols-1 gap-2 text-sm">
                    <a class="rounded-lg bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('equipamentos.index') }}">Equipamentos</a>
                    <a class="rounded-lg bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('equipamentos.levantamento') }}">Levantamento</a>
                    <a class="rounded-lg bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('tipos-equipamento.index') }}">Tipos</a>
                    <a class="rounded-lg bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('marcas.index') }}">Marcas</a>
                    <a class="rounded-lg bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('cidades-comarcas.index') }}">Cidades</a>
                    <a class="rounded-lg bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('varas.index') }}">Varas</a>
                    <a class="rounded-lg bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('setores.index') }}">Setores</a>
                    @if(auth()->user()?->canManageUsers())
                    <a class="rounded-lg bg-amber-500/20 px-3 py-2 text-amber-200 hover:bg-amber-500/30" href="{{ route('usuarios.index') }}">Usuários</a>
                    @endif
                    <div class="border-t border-slate-700/50 pt-2 mt-1 flex items-center justify-between px-1">
                        <a href="{{ route('perfil.edit') }}" class="group">
                            <p class="text-xs font-semibold text-white group-hover:text-cyan-300 transition-colors">{{ auth()->user()?->name }}</p>
                            <p class="text-xs text-slate-400">{{ auth()->user()?->papel?->label() }} · <span class="text-cyan-400">Meu perfil</span></p>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Sair
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-6 md:py-8">
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 p-4 rounded-xl border border-emerald-200/50 bg-gradient-to-r from-emerald-50 to-green-50 shadow-lg shadow-emerald-500/10">
                <div class="flex-shrink-0 p-2 rounded-lg bg-emerald-100">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 flex items-center gap-3 p-4 rounded-xl border border-red-200/50 bg-gradient-to-r from-red-50 to-rose-50 shadow-lg shadow-red-500/10">
                <div class="flex-shrink-0 p-2 rounded-lg bg-red-100">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50 shadow-lg">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="font-semibold text-red-800">Corrija os campos:</p>
                </div>
                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <div id="barcode-scanner-modal" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm p-4">
        <div class="mx-auto mt-8 max-w-md rounded-2xl bg-white shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 px-4 py-3 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    Leitor de código
                </h2>
                <button id="barcode-close" type="button" class="text-slate-400 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-4 space-y-3">
                <p class="text-sm text-slate-600">Aponte a câmera para o código de barras.</p>
                <video id="barcode-video" class="w-full rounded-xl bg-slate-900 aspect-video" autoplay playsinline muted></video>
                <p id="barcode-status" class="text-sm text-slate-500 text-center"></p>
            </div>
        </div>
    </div>
</body>
</html>
