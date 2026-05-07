@extends('layouts.app')

@section('title', 'Detalhes do Equipamento')

@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detalhes do equipamento</h1>
            <p class="text-slate-500 text-sm mt-1">Informações completas do registro</p>
        </div>
        <div class="flex gap-2">
            @if(auth()->user()->canEdit())
            <a href="{{ route('equipamentos.edit', $equipamento) }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Editar
            </a>
            @endif
            <a href="{{ route('equipamentos.index') }}" class="btn-muted">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Voltar
            </a>
        </div>
    </div>

    <div class="panel p-5">
        <div class="flex items-start gap-4 pb-5 border-b border-slate-200">
            <div class="p-3 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 shadow-lg shadow-cyan-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">Código patrimônio</p>
                <p class="text-2xl font-bold text-slate-900">{{ $equipamento->codigo_patrimonio }}</p>
            </div>
            <span class="ml-auto badge badge-cyan">{{ $equipamento->tipoEquipamento?->nome }}</span>
        </div>

        <dl class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 pt-5">
            <div>
                <dt class="text-sm font-medium text-slate-500 mb-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    Marca
                </dt>
                <dd class="text-base font-medium text-slate-900">{{ $equipamento->marca?->nome ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500 mb-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Modelo
                </dt>
                <dd class="text-base font-medium text-slate-900">{{ $equipamento->modelo ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500 mb-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Cidade/Comarca
                </dt>
                <dd class="text-base font-medium text-slate-900">{{ $equipamento->cidadeComarca?->nome }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500 mb-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Vara
                </dt>
                <dd class="text-base font-medium text-slate-900">{{ $equipamento->vara?->nome ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500 mb-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Setor
                </dt>
                <dd class="text-base font-medium text-slate-900">{{ $equipamento->setor?->nome ?? '-' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500 mb-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Data de cadastro
                </dt>
                <dd class="text-base font-medium text-slate-900">{{ $equipamento->created_at?->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="md:col-span-2 lg:col-span-3">
                <dt class="text-sm font-medium text-slate-500 mb-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Observações
                </dt>
                <dd class="text-base text-slate-900 p-4 rounded-xl bg-slate-50 border border-slate-200">{{ $equipamento->observacoes ?: 'Nenhuma observação registrada' }}</dd>
            </div>
        </dl>
    </div>

    @if(auth()->user()->canEdit())
    <div class="panel p-5 border-red-200 bg-red-50/50">
        <h3 class="text-sm font-semibold text-red-800 mb-3">Zona de risco</h3>
        <form method="POST" action="{{ route('equipamentos.destroy', $equipamento) }}" class="flex items-center gap-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-red-600 text-white hover:bg-red-700 shadow-lg shadow-red-500/20" onclick="return confirm('Tem certeza que deseja excluir este equipamento? Esta ação não pode ser desfeita.')">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Excluir equipamento
            </button>
            <span class="text-sm text-red-600">Esta ação é irreversível.</span>
        </form>
    </div>
    @endif

    <div class="panel p-5 border-l-4 border-l-cyan-500 bg-cyan-50/50">
        <div class="flex items-center gap-2 text-sm text-slate-600">
            <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Última atualização: {{ $equipamento->updated_at?->format('d/m/Y H:i') }}</span>
        </div>
    </div>
</div>
@endsection