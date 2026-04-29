<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f172a">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>{{ config('app.name', 'Patrimonio TI') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-slate-900">
    <header class="border-b border-cyan-900/20 bg-slate-950/90 text-white backdrop-blur sticky top-0 z-40 shadow-[0_8px_30px_-20px_rgba(8,145,178,0.85)]">
        <div class="mx-auto max-w-6xl px-4 py-3 flex flex-wrap items-center gap-3">
            <a href="{{ route('dashboard') }}" class="text-lg font-extrabold tracking-tight text-cyan-200">Inventario TI</a>
            <nav class="flex flex-wrap gap-2 text-sm">
                <a class="rounded-full bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('equipamentos.index') }}">Equipamentos</a>
                <a class="rounded-full bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('equipamentos.levantamento') }}">Levantamento</a>
                <a class="rounded-full bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('tipos-equipamento.index') }}">Tipos</a>
                <a class="rounded-full bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('marcas.index') }}">Marcas</a>
                <a class="rounded-full bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('cidades-comarcas.index') }}">Cidades</a>
                <a class="rounded-full bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('varas.index') }}">Varas</a>
                <a class="rounded-full bg-white/10 px-3 py-2 text-cyan-100 hover:bg-white/20" href="{{ route('setores.index') }}">Setores</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl p-4 md:p-6">
        @if (session('success'))
            <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 shadow-sm">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 shadow-sm">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 shadow-sm">
                <p class="font-semibold mb-1">Corrija os campos:</p>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <div id="barcode-scanner-modal" class="hidden fixed inset-0 z-50 bg-black/70 p-4">
        <div class="mx-auto mt-8 max-w-md rounded-xl bg-white p-4 space-y-3">
            <h2 class="text-lg font-semibold">Leitor de codigo</h2>
            <p class="text-sm text-slate-600">Aponte a camera para o codigo de barras.</p>
            <video id="barcode-video" class="w-full rounded-lg bg-slate-900" autoplay playsinline muted></video>
            <p id="barcode-status" class="text-sm text-slate-600"></p>
            <button id="barcode-close" type="button" class="w-full rounded-md bg-slate-200 px-4 py-2 font-semibold">Cancelar leitura</button>
        </div>
    </div>
</body>
</html>
