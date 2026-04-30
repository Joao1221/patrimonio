@extends('layouts.app')

@section('title', 'Equipamentos')

@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Equipamentos</h1>
            <p class="text-slate-500 text-sm mt-1">Gerencie o inventário de equipamentos</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('equipamentos.levantamento') }}" class="btn-muted">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Levantamento
            </a>
            <a href="{{ route('equipamentos.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Novo cadastro
            </a>
        </div>
    </div>

    <form method="GET" class="panel p-4 flex flex-wrap items-end gap-2 border-l-4 border-l-cyan-500">
        <div class="flex-1 min-w-[120px]">
            <input id="filtro_codigo_camera" name="codigo_patrimonio" value="{{ $filters['codigo_patrimonio'] ?? '' }}" placeholder="Buscar patrimônio" class="w-full rounded-lg border-slate-200 text-sm py-2">
        </div>
        <div class="flex-1 min-w-[100px]">
            <select name="tipo_equipamento_id" class="w-full rounded-lg border-slate-200 text-sm py-2">
                <option value="">Tipo</option>
                @foreach ($tipos as $item)
                    <option value="{{ $item->id }}" @selected(($filters['tipo_equipamento_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-[100px]">
            <select name="marca_id" class="w-full rounded-lg border-slate-200 text-sm py-2">
                <option value="">Marca</option>
                @foreach ($marcas as $item)
                    <option value="{{ $item->id }}" @selected(($filters['marca_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-[100px]">
            <select name="cidade_comarca_id" class="w-full rounded-lg border-slate-200 text-sm py-2">
                <option value="">Cidade</option>
                @foreach ($cidades as $item)
                    <option value="{{ $item->id }}" @selected(($filters['cidade_comarca_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-[100px]">
            <select name="vara_id" class="w-full rounded-lg border-slate-200 text-sm py-2">
                <option value="">Vara</option>
                @foreach ($varas as $item)
                    <option value="{{ $item->id }}" @selected(($filters['vara_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn-secondary whitespace-nowrap">Filtrar</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="stat-card !bg-cyan-50 !border-cyan-200">
            <p class="text-sm font-medium text-cyan-700">Total geral</p>
            <p class="text-3xl font-extrabold mt-1 text-cyan-900">{{ $totalGeral }}</p>
        </div>
        <div class="stat-card !bg-violet-50 !border-violet-200">
            <p class="text-sm font-medium text-violet-700">Total por cidade</p>
            <p class="text-3xl font-extrabold mt-1 text-violet-900">{{ $totalCidade }}</p>
            @if($filters['cidade_comarca_id'] ?? false)
                <p class="text-xs text-violet-600 mt-1">{{ $cidades->find($filters['cidade_comarca_id'])?->nome }}</p>
            @endif
        </div>
        <div class="stat-card !bg-amber-50 !border-amber-200">
            <p class="text-sm font-medium text-amber-700">Total por vara</p>
            <p class="text-3xl font-extrabold mt-1 text-amber-900">{{ $totalVara }}</p>
            @if($filters['vara_id'] ?? false)
                <p class="text-xs text-amber-600 mt-1">{{ $varas->find($filters['vara_id'])?->nome }}</p>
            @endif
        </div>
    </div>

    <div class="space-y-3 md:hidden">
        @forelse ($equipamentos as $eq)
            <article class="panel p-4 hover:shadow-lg transition-shadow border-l-4 border-l-cyan-500">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-bold text-slate-900 text-lg">{{ $eq->codigo_patrimonio }}</p>
                        <p class="text-sm text-slate-600 mt-1">{{ $eq->tipoEquipamento?->nome }}</p>
                    </div>
                    <span class="badge badge-cyan">{{ $eq->cidadeComarca?->nome }}</span>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <p class="text-xs text-slate-500">{{ $eq->marca?->nome }} · {{ $eq->setor?->nome }}</p>
                    <a href="{{ route('equipamentos.show', $eq) }}" class="text-cyan-600 hover:text-cyan-800 font-medium text-sm">Ver detalhes →</a>
                </div>
            </article>
        @empty
            <div class="empty-state panel">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                <p class="text-slate-500">Nenhum equipamento encontrado</p>
                <a href="{{ route('equipamentos.create') }}" class="btn-primary mt-4">Cadastrar equipamento</a>
            </div>
        @endforelse
    </div>

    <div class="hidden md:block panel overflow-hidden border-t-4 border-t-cyan-500">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Patrimônio</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tipo</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Marca</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Cidade</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Vara</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Setor</th>
                    <th class="p-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipamentos as $eq)
                    <tr class="border-b border-slate-100 hover:bg-cyan-50/50 transition-colors border-l-2 border-l-transparent hover:border-l-cyan-400">
                        <td class="p-4 font-bold text-slate-900">{{ $eq->codigo_patrimonio }}</td>
                        <td class="p-4"><span class="badge badge-cyan">{{ $eq->tipoEquipamento?->nome }}</span></td>
                        <td class="p-4 text-slate-600">{{ $eq->marca?->nome ?? '-' }}</td>
                        <td class="p-4 text-slate-600">{{ $eq->cidadeComarca?->nome }}</td>
                        <td class="p-4 text-slate-600">{{ $eq->vara?->nome ?? '-' }}</td>
                        <td class="p-4 text-slate-600">{{ $eq->setor?->nome ?? '-' }}</td>
                        <td class="p-4 text-right">
                            <a href="{{ route('equipamentos.show', $eq) }}" class="inline-flex items-center gap-1 text-cyan-600 hover:text-cyan-800 font-medium transition-colors">
                                Abrir
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($equipamentos->hasPages())
    <div class="flex justify-center">
        <nav class="flex items-center gap-1">
            {{ $equipamentos->links() }}
        </nav>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtro_codigo_camera');

    const filtrarOuBuscar = async (e) => {
        const codigo = input.value.trim();
        
        if (!codigo) {
            return true;
        }

        let baseUrl = '';
        if (window.location.pathname.includes('/patrimonio')) {
            baseUrl = '/patrimonio/public';
        }

        try {
            const resp = await fetch(`${baseUrl}/api/equipamentos/buscar-por-codigo/${encodeURIComponent(codigo)}`);
            const data = await resp.json();
            if (resp.ok && data.id) {
                window.location.href = `${baseUrl}/equipamentos/${data.id}`;
                return false;
            }
        } catch (err) {
            console.error('Erro na busca:', err);
        }

        const confirmar = confirm('Equipamento não encontrado. Deseja cadastrá-lo com este código?');
        if (confirmar) {
            window.location.href = baseUrl + '/equipamentos/create?codigo_patrimonio=' + encodeURIComponent(codigo);
        }
        return false;
    };

    input?.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            filtrarOuBuscar(e);
        }
    });

    const form = input?.closest('form');
    form?.addEventListener('submit', (e) => {
        const codigo = input.value.trim();
        if (codigo) {
            e.preventDefault();
            filtrarOuBuscar(e);
        }
    });
});
</script>
@endsection