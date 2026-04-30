@extends('layouts.app')

@section('title', 'Detalhes do ' . $tituloSingular)

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $titulo }}</h1>
            <p class="text-slate-500 text-sm mt-1">Detalhes do registro</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route($rota.'.edit', $item) }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Editar
            </a>
            <a href="{{ route($rota.'.index') }}" class="btn-muted">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Voltar
            </a>
        </div>
    </div>

    <div class="panel p-5">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <dt class="text-sm font-medium text-slate-500 mb-1">Nome</dt>
                <dd class="text-lg font-semibold text-slate-900">{{ $item->nome }}</dd>
            </div>
            @if ($campoCidade ?? false)
                <div>
                    <dt class="text-sm font-medium text-slate-500 mb-1">Cidade/Comarca</dt>
                    <dd class="text-lg text-slate-900">{{ $item->cidadeComarca?->nome }}</dd>
                </div>
            @endif
            <div>
                <dt class="text-sm font-medium text-slate-500 mb-1">Status</dt>
                <dd>
                    @if($item->ativo)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Ativo
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Inativo
                        </span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>

    @if($item->ativo)
    <div class="panel p-5 border-red-200 bg-red-50/50">
        <h3 class="text-sm font-semibold text-red-800 mb-3">Zona de risco</h3>
        <form method="POST" action="{{ route($rota.'.destroy', $item) }}" class="flex items-center gap-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-red-600 text-white hover:bg-red-700 shadow-lg shadow-red-500/20" onclick="return confirm('Tem certeza que deseja desativar este registro?')">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Desativar registro
            </button>
            <span class="text-sm text-red-600">Esta ação não remove o registro, apenas o desativa.</span>
        </form>
    </div>
    @endif
</div>
@endsection