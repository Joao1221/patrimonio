@extends('layouts.app')

@section('title', 'Equipamentos')

@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Equipamentos</h1>
            <p class="text-slate-500 text-sm mt-1">Gerencie o inventário de equipamentos</p>
        </div>
        @if(auth()->user()->canEdit())
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
        @endif
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
        @if($cidadeRestrita)
            {{-- Usuário restrito a uma cidade: campo oculto garante filtro, badge informa --}}
            <input type="hidden" id="filtro_cidade" name="cidade_comarca_id" value="{{ $cidadeRestrita }}">
            <div class="flex items-center gap-1.5 px-3 py-2 rounded-lg bg-cyan-50 border border-cyan-200 text-xs font-semibold text-cyan-800 whitespace-nowrap">
                <svg class="w-3.5 h-3.5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $cidades->first()?->nome }}
            </div>
        @else
            <div class="flex-1 min-w-[100px]">
                <select id="filtro_cidade" name="cidade_comarca_id" class="w-full rounded-lg border-slate-200 text-sm py-2">
                    <option value="">Cidade</option>
                    @foreach ($cidades as $item)
                        <option value="{{ $item->id }}" @selected(($filters['cidade_comarca_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="flex-1 min-w-[100px]">
            <select id="filtro_vara" name="vara_id" class="w-full rounded-lg border-slate-200 text-sm py-2">
                <option value="">Vara</option>
                @foreach ($varas as $item)
                    <option value="{{ $item->id }}" @selected(($filters['vara_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn-secondary whitespace-nowrap">Filtrar</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <article class="stat-card !bg-cyan-50 !border-cyan-200 panel-hover group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-cyan-700">Total de equipamentos</p>
                    <p id="stats-total" class="text-4xl font-extrabold mt-2 text-cyan-900">{{ $totalEquipamentos }}</p>
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
                <span id="stats-total-tipos" class="text-xs text-slate-400">{{ $totaisPorTipo->sum('equipamentos_count') }} equipamentos</span>
            </div>
            <div id="stats-por-tipo" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach ($totaisPorTipo as $item)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-violet-50 border border-violet-100 hover:border-violet-300 hover:bg-violet-100 transition-all duration-200">
                        <span class="text-sm font-medium text-violet-700 truncate">{{ $item->nome }}</span>
                        <span class="flex-shrink-0 px-2.5 py-0.5 rounded-full text-xs font-bold bg-violet-200 text-violet-800">{{ $item->equipamentos_count }}</span>
                    </div>
                @endforeach
            </div>
        </article>
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
    const baseUrl = `{{ rtrim(request()->getSchemeAndHttpHost() . request()->getBasePath(), '/') }}`;

    const filtroVara    = document.getElementById('filtro_vara');
    const filtroCidade  = document.getElementById('filtro_cidade');
    const selectedVara  = "{{ $filters['vara_id'] ?? '' }}";
    const filterForm    = filtroCidade.closest('form');

    // Popula varas ao carregar a página quando cidade já está selecionada (filtro ativo)
    async function carregarVarasFiltro() {
        const cidadeId = filtroCidade.value;
        filtroVara.innerHTML = '<option value="">Vara</option>';
        if (!cidadeId) return;
        const response = await fetch(`${baseUrl}/api/cidades-comarcas/${cidadeId}/varas`);
        const data = await response.json();
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.nome;
            if (String(item.id) === String(selectedVara)) option.selected = true;
            filtroVara.appendChild(option);
        });
    }

    if (filtroCidade.value) carregarVarasFiltro();

    // Ao trocar a cidade: limpa vara e submete (tabela + cards atualizam via reload)
    filtroCidade.addEventListener('change', () => {
        filtroVara.value = '';
        filterForm.submit();
    });

    // Demais selects: submete imediatamente ao mudar
    filterForm.querySelectorAll('select:not(#filtro_cidade)').forEach(sel => {
        sel.addEventListener('change', () => filterForm.submit());
    });

    // Busca por código de barras
    const input = document.getElementById('filtro_codigo_camera');

    const filtrarOuBuscar = async () => {
        const codigo = input.value.trim();
        if (!codigo) return;
        try {
            const resp = await fetch(`${baseUrl}/api/equipamentos/buscar-por-codigo/${encodeURIComponent(codigo)}`);
            const data = await resp.json();
            if (resp.ok && data.id) {
                window.location.href = `${baseUrl}/equipamentos/${data.id}`;
                return;
            }
        } catch (err) {
            console.error('Erro na busca:', err);
        }
        if (confirm('Equipamento não encontrado. Deseja cadastrá-lo com este código?')) {
            window.location.href = `${baseUrl}/equipamentos/create?codigo_patrimonio=` + encodeURIComponent(codigo);
        }
    };

    input?.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') { e.preventDefault(); filtrarOuBuscar(); }
    });

    filterForm.addEventListener('submit', (e) => {
        if (input.value.trim()) { e.preventDefault(); filtrarOuBuscar(); }
    });
});
</script>
@endsection