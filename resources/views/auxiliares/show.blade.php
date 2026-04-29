@extends('layouts.app')

@section('content')
<div class="panel p-4 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">{{ $titulo }}</h1>
        <div class="flex gap-2">
            <a href="{{ route($rota.'.edit', $item) }}" class="btn-primary">Editar</a>
            <a href="{{ route($rota.'.index') }}" class="btn-muted">Voltar</a>
        </div>
    </div>
    <dl class="text-sm space-y-2">
        <div><dt class="text-slate-500">Nome</dt><dd class="font-semibold">{{ $item->nome }}</dd></div>
        @if ($campoCidade ?? false)
            <div><dt class="text-slate-500">Cidade/Comarca</dt><dd>{{ $item->cidadeComarca?->nome }}</dd></div>
        @endif
        <div><dt class="text-slate-500">Ativo</dt><dd>{{ $item->ativo ? 'Sim' : 'Nao' }}</dd></div>
    </dl>
    <form method="POST" action="{{ route($rota.'.destroy', $item) }}">
        @csrf
        @method('DELETE')
        <button class="btn inline-flex items-center rounded-xl bg-red-600 text-white hover:bg-red-700">Desativar registro</button>
    </form>
</div>
@endsection
