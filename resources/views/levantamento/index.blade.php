@extends('layouts.app')

@section('title', 'Levantamento')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Levantamento em lote</h1>
        <p class="text-slate-500 text-sm mt-1">Cadastre rapidamente vários equipamentos</p>
    </div>

    <form id="levantamento-form" method="POST" action="{{ route('equipamentos.levantamento.store') }}" class="panel p-5 space-y-5">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Cidade/Comarca <span class="text-red-500">*</span>
                </label>
                @if($cidadeRestrita)
                    <input type="hidden" id="cidade_comarca_id" name="cidade_comarca_id" value="{{ $cidadeRestrita }}">
                    <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-cyan-50 border border-cyan-200 text-sm font-semibold text-cyan-800">
                        <svg class="w-4 h-4 text-cyan-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $cidades->first()?->nome }}
                    </div>
                @else
                    <select id="cidade_comarca_id" name="cidade_comarca_id" class="rounded-lg border-slate-200 w-full" required>
                        <option value="">Selecione</option>
                        @foreach ($cidades as $cidade)
                            <option value="{{ $cidade->id }}" @selected(old('cidade_comarca_id', $contexto['cidade_comarca_id'] ?? null) == $cidade->id)>{{ $cidade->nome }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="space-y-2">
                <label for="vara_id" class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Vara
                </label>
                <select id="vara_id" name="vara_id" class="rounded-lg border-slate-200 w-full">
                    <option value="">Selecione</option>
                    @foreach ($varas as $vara)
                        <option value="{{ $vara->id }}" data-cidade="{{ $vara->cidade_comarca_id }}" @selected(old('vara_id', $contexto['vara_id'] ?? null) == $vara->id)>{{ $vara->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label for="setor_id" class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Setor
                </label>
                <select id="setor_id" name="setor_id" class="rounded-lg border-slate-200 w-full">
                    <option value="">Selecione</option>
                    @foreach ($setores as $setor)
                        <option value="{{ $setor->id }}" @selected(old('setor_id', $contexto['setor_id'] ?? null) == $setor->id)>{{ $setor->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label for="tipo_equipamento_id" class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                    Tipo de equipamento <span class="text-red-500">*</span>
                </label>
                <select id="tipo_equipamento_id" name="tipo_equipamento_id" class="rounded-lg border-slate-200 w-full" required>
                    <option value="">Selecione</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}" @selected(old('tipo_equipamento_id', $contexto['tipo_equipamento_id'] ?? null) == $tipo->id)>{{ $tipo->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label for="marca_id" class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    Marca
                </label>
                <select id="marca_id" name="marca_id" class="rounded-lg border-slate-200 w-full">
                    <option value="">Selecione</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" @selected(old('marca_id', $contexto['marca_id'] ?? null) == $marca->id)>{{ $marca->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label for="modelo" class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Modelo
                </label>
                <input id="modelo" name="modelo" value="{{ old('modelo', $contexto['modelo'] ?? '') }}" placeholder="Digite o modelo" class="rounded-lg border-slate-200 w-full">
            </div>
        </div>

        <div class="border-t border-slate-200 pt-5">
            <div class="space-y-2">
                <label for="codigo_patrimonio" class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                    Código patrimônio <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-2 items-center">
                    <input id="codigo_patrimonio" name="codigo_patrimonio" type="number" inputmode="numeric" placeholder="Digite o código" class="flex-1 rounded-lg border-slate-200" required autofocus min="1" max="999999" maxlength="6">
                    <button name="acao" value="continuar" class="btn-primary whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Salvar
                    </button>
                </div>
                <div id="codigo-feedback" class="hidden rounded-lg border px-4 py-3 text-sm flex items-center gap-2"></div>
            </div>

            <div class="mt-4 space-y-2">
                <label for="observacoes" class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Observações
                </label>
                <textarea id="observacoes" name="observacoes" placeholder="Digite as observações" class="w-full rounded-lg border-slate-200" rows="2"></textarea>
            </div>
        </div>
    </form>

    <div class="panel p-5">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-cyan-100">
                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="font-semibold text-slate-800">Cadastrados nesta sessão</p>
                    <p class="text-sm text-slate-500">{{ $contador }} equipamento(s)</p>
                </div>
            </div>
        </div>
        @if($ultimos->count() > 0)
            <div class="border-t border-slate-200 pt-4">
                <h3 class="text-sm font-semibold text-slate-700 mb-3">Últimos cadastrados</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($ultimos as $item)
                        <a href="{{ route('equipamentos.show', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200 hover:border-cyan-300 hover:bg-cyan-50 transition-all">
                            <span class="font-bold text-slate-900">{{ $item->codigo_patrimonio }}</span>
                            <span class="text-xs text-slate-500">·</span>
                            <span class="text-xs text-slate-600">{{ $item->tipoEquipamento?->nome }}</span>
                            <span class="text-xs text-slate-400">·</span>
                            <span class="text-xs text-slate-500">{{ $item->setor?->nome }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-center text-slate-400 py-4">Nenhum registro nesta sessão</p>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('levantamento-form');
    const cidade = document.getElementById('cidade_comarca_id');
    const vara = document.getElementById('vara_id');
    const codigo = document.getElementById('codigo_patrimonio');
    const obs = document.getElementById('observacoes');
    const feedback = document.getElementById('codigo-feedback');
    const contextFields = ['cidade_comarca_id', 'vara_id', 'setor_id', 'tipo_equipamento_id', 'marca_id', 'modelo'];
    const storageKey = 'levantamento_contexto';

    const applyVaraFilter = () => {
        const cidadeId = cidade.value;
        [...vara.options].forEach((option, index) => {
            if (index === 0) {
                option.hidden = false;
                return;
            }
            option.hidden = cidadeId && option.dataset.cidade !== cidadeId;
            if (option.hidden && option.selected) {
                vara.value = '';
            }
        });
    };

    const saveContext = () => {
        const payload = {};
        contextFields.forEach((name) => {
            payload[name] = form.elements[name]?.value ?? '';
        });
        localStorage.setItem(storageKey, JSON.stringify(payload));
    };

    const restoreContext = () => {
        const raw = localStorage.getItem(storageKey);
        if (!raw) return;
        try {
            const data = JSON.parse(raw);
            contextFields.forEach((name) => {
                const field = form.elements[name];
                if (!field || field.value) return;
                field.value = data[name] ?? '';
            });
        } catch (_) {}
    };

    const resetOperationalFields = () => {
        codigo.value = '';
        obs.value = '';
        codigo.focus();
        feedback.classList.add('hidden');
    };

    codigo.addEventListener('input', () => {
        if (codigo.value.length > 6) {
            codigo.value = codigo.value.slice(0, 6);
        }
    });

    const checkCodigoDuplicado = async () => {
        const value = codigo.value.trim();
        if (!value) {
            feedback.classList.add('hidden');
            return;
        }
        const response = await fetch(`/equipamentos-levantamento/verificar-codigo/${encodeURIComponent(value)}`);
        const data = await response.json();
        if (data.exists && data.equipamento) {
            feedback.className = 'rounded-lg border border-amber-300 bg-amber-50 px-4 py-3 text-sm flex items-start gap-2 text-amber-800';
            feedback.innerHTML = `<svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg><div>Este código/patrimônio já está cadastrado na cidade: <strong>${data.equipamento.cidade_comarca?.nome || 'Desconhecida'}</strong>. <a class="underline font-medium" href="/equipamentos/${data.equipamento.id}">Abrir equipamento</a>.</div>`;
            feedback.classList.remove('hidden');
        } else {
            feedback.classList.add('hidden');
        }
    };

    restoreContext();
    applyVaraFilter();
    contextFields.forEach((name) => {
        form.elements[name]?.addEventListener('change', () => {
            if (name === 'cidade_comarca_id') {
                applyVaraFilter();
            }
            saveContext();
        });
        form.elements[name]?.addEventListener('input', saveContext);
    });

    codigo.addEventListener('blur', checkCodigoDuplicado);
    form.addEventListener('submit', () => {
        saveContext();
    });
});
</script>
@endsection