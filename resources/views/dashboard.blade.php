@extends('layouts.app')

@section('title', 'Controle de Patrimônio')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
            <p class="text-slate-500 text-sm mt-1">Visão geral do inventário de equipamentos</p>
        </div>
        <a href="{{ route('equipamentos.levantamento') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Levantamento em lote
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <article class="stat-card !bg-cyan-50 !border-cyan-200 panel-hover group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-cyan-700">Total de equipamentos</p>
                    <p class="text-4xl font-extrabold mt-2 text-cyan-900">{{ $totalEquipamentos }}</p>
                </div>
                <div class="p-3 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 shadow-lg shadow-cyan-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-xs text-emerald-600 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                Inventário ativo
            </div>
        </article>

        <article class="md:col-span-2 panel p-5 border-l-4 border-l-violet-500">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-semibold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Total por tipo
                </h2>
                <span class="text-xs text-slate-400">{{ $totaisPorTipo->sum('equipamentos_count') }} equipamentos</span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($totaisPorTipo as $item)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-violet-50 border border-violet-100 hover:border-violet-300 hover:bg-violet-100 transition-all duration-200">
                        <span class="text-sm font-medium text-violet-700 truncate">{{ $item->nome }}</span>
                        <span class="flex-shrink-0 px-2.5 py-0.5 rounded-full text-xs font-bold bg-violet-200 text-violet-800">{{ $item->equipamentos_count }}</span>
                    </div>
                @endforeach
            </div>
        </article>
    </div>

    <article class="panel p-5 border-l-4 border-l-amber-500">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Total por cidade/comarca
            </h2>
            <span class="text-xs text-slate-400">Clique para filtrar</span>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
            @foreach ($totaisPorCidade as $item)
                <a href="{{ route('equipamentos.index', ['cidade_comarca_id' => $item->id]) }}" class="flex items-center justify-between p-3 rounded-xl bg-amber-50 border border-amber-100 hover:border-amber-300 hover:bg-amber-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
                    <span class="text-sm font-medium text-amber-700 truncate group-hover:text-amber-900">{{ $item->nome }}</span>
                    <span class="flex-shrink-0 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-200 text-amber-800 group-hover:bg-amber-300">{{ $item->equipamentos_count }}</span>
                </a>
            @endforeach
        </div>
    </article>

    <article class="panel p-5 border-t-4 border-t-emerald-500">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Últimos cadastrados
            </h2>
            <a href="{{ route('equipamentos.index') }}" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium">Ver todos →</a>
        </div>
        <div class="overflow-x-auto -mx-5 px-5">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-emerald-50">
                        <th class="py-3 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Patrimônio</th>
                        <th class="py-3 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Tipo</th>
                        <th class="py-3 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Cidade</th>
                        <th class="py-3 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Setor</th>
                        <th class="py-3 text-right text-xs font-semibold text-emerald-700 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ultimosEquipamentos as $eq)
                        <tr class="border-b border-slate-100 hover:bg-emerald-50/50 transition-colors border-l-2 border-l-transparent hover:border-l-emerald-400">
                            <td class="py-3 font-semibold text-slate-900">{{ $eq->codigo_patrimonio }}</td>
                            <td class="py-3"><span class="badge badge-cyan">{{ $eq->tipoEquipamento?->nome }}</span></td>
                            <td class="py-3 text-slate-600">{{ $eq->cidadeComarca?->nome }}</td>
                            <td class="py-3 text-slate-600">{{ $eq->setor?->nome }}</td>
                            <td class="py-3 text-right">
                                <a href="{{ route('equipamentos.show', $eq) }}" class="inline-flex items-center gap-1 text-cyan-600 hover:text-cyan-800 font-medium transition-colors">
                                    Abrir
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                Sem equipamentos cadastrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </article>
</div>
@endsection