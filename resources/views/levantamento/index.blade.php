@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <h1 class="text-2xl font-bold">Levantamento em lote</h1>
    <form id="levantamento-form" method="POST" action="{{ route('equipamentos.levantamento.store') }}" class="panel p-4 space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <select id="cidade_comarca_id" name="cidade_comarca_id" class="rounded-md border-slate-300" required>
                <option value="">Cidade/Comarca</option>
                @foreach ($cidades as $cidade)
                    <option value="{{ $cidade->id }}" @selected(old('cidade_comarca_id', $contexto['cidade_comarca_id'] ?? null) == $cidade->id)>{{ $cidade->nome }}</option>
                @endforeach
            </select>
            <select id="vara_id" name="vara_id" class="rounded-md border-slate-300">
                <option value="">Vara</option>
                @foreach ($varas as $vara)
                    <option value="{{ $vara->id }}" data-cidade="{{ $vara->cidade_comarca_id }}" @selected(old('vara_id', $contexto['vara_id'] ?? null) == $vara->id)>{{ $vara->nome }}</option>
                @endforeach
            </select>
            <select id="setor_id" name="setor_id" class="rounded-md border-slate-300">
                <option value="">Setor</option>
                @foreach ($setores as $setor)
                    <option value="{{ $setor->id }}" @selected(old('setor_id', $contexto['setor_id'] ?? null) == $setor->id)>{{ $setor->nome }}</option>
                @endforeach
            </select>
            <select id="tipo_equipamento_id" name="tipo_equipamento_id" class="rounded-md border-slate-300" required>
                <option value="">Tipo de equipamento</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}" @selected(old('tipo_equipamento_id', $contexto['tipo_equipamento_id'] ?? null) == $tipo->id)>{{ $tipo->nome }}</option>
                @endforeach
            </select>
            <select id="marca_id" name="marca_id" class="rounded-md border-slate-300">
                <option value="">Marca</option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}" @selected(old('marca_id', $contexto['marca_id'] ?? null) == $marca->id)>{{ $marca->nome }}</option>
                @endforeach
            </select>
            <input id="modelo" name="modelo" value="{{ old('modelo', $contexto['modelo'] ?? '') }}" placeholder="Modelo" class="rounded-md border-slate-300">
        </div>
        <div class="space-y-2">
            <div class="flex gap-2">
                <input id="codigo_patrimonio" name="codigo_patrimonio" placeholder="Codigo patrimonio" class="w-full rounded-md border-slate-300" required autofocus>
                <button type="button" data-open-scanner data-target-input="codigo_patrimonio" class="btn-secondary">Ler codigo</button>
            </div>
            <div id="codigo-feedback" class="hidden rounded-md border px-3 py-2 text-sm"></div>
        </div>
        <textarea id="observacoes" name="observacoes" placeholder="Observacoes" class="w-full rounded-md border-slate-300" rows="3"></textarea>
        <div class="flex flex-col md:flex-row gap-2">
            <button name="acao" value="continuar" class="btn-primary w-full md:w-auto">Salvar e ler proximo</button>
            <button name="acao" value="salvar" class="btn-secondary w-full md:w-auto">Salvar</button>
            <button id="limpar-codigo" type="button" class="btn-muted w-full md:w-auto">Limpar codigo</button>
        </div>
    </form>

    <div class="panel p-4">
        <p class="font-semibold">Cadastrados nesta sessao: {{ $contador }}</p>
        <h2 class="font-semibold mt-3 mb-2">Ultimos cadastrados</h2>
        <ul class="space-y-1 text-sm">
            @forelse ($ultimos as $item)
                <li>{{ $item->codigo_patrimonio }} - {{ $item->tipoEquipamento?->nome }} - {{ $item->setor?->nome }}</li>
            @empty
                <li class="text-slate-500">Nenhum registro na sessao.</li>
            @endforelse
        </ul>
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
    const limparCodigo = document.getElementById('limpar-codigo');
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

    const checkCodigoDuplicado = async () => {
        const value = codigo.value.trim();
        if (!value) {
            feedback.classList.add('hidden');
            return;
        }
        const response = await fetch(`/equipamentos-levantamento/verificar-codigo/${encodeURIComponent(value)}`);
        const data = await response.json();
        if (data.exists && data.equipamento) {
            feedback.className = 'rounded-md border border-amber-300 bg-amber-50 px-3 py-2 text-sm text-amber-800';
            feedback.innerHTML = `Este codigo/patrimonio ja esta cadastrado. <a class="underline" href="/equipamentos/${data.equipamento.id}">Abrir equipamento existente</a>.`;
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

    limparCodigo.addEventListener('click', resetOperationalFields);
    codigo.addEventListener('blur', checkCodigoDuplicado);
    form.addEventListener('submit', () => {
        saveContext();
    });
});
</script>
@endsection
