@php
    $eq = $equipamento ?? null;
@endphp
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm mb-1">Tipo *</label>
        <select name="tipo_equipamento_id" class="w-full rounded-md border-slate-300" required>
            <option value="">Selecione</option>
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo->id }}" @selected(old('tipo_equipamento_id', $eq?->tipo_equipamento_id) == $tipo->id)>{{ $tipo->nome }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm mb-1">Codigo patrimonio *</label>
        <div class="flex gap-2">
            <input id="codigo_patrimonio" type="text" name="codigo_patrimonio" class="w-full rounded-md border-slate-300" value="{{ old('codigo_patrimonio', $eq?->codigo_patrimonio ?? ($codigo_patrimonio ?? '')) }}" required>
            <button type="button" data-open-scanner data-target-input="codigo_patrimonio" class="rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-semibold">Ler codigo</button>
        </div>
        <div id="codigo-duplicado-feedback" class="hidden mt-2 rounded-md border px-3 py-2 text-sm"></div>
    </div>
    <div>
        <label class="block text-sm mb-1">Marca</label>
        <select name="marca_id" class="w-full rounded-md border-slate-300">
            <option value="">Selecione</option>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}" @selected(old('marca_id', $eq?->marca_id) == $marca->id)>{{ $marca->nome }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm mb-1">Modelo</label>
        <input type="text" name="modelo" maxlength="150" class="w-full rounded-md border-slate-300" value="{{ old('modelo', $eq?->modelo) }}">
    </div>
    <div>
        <label class="block text-sm mb-1">Cidade/Comarca *</label>
        <select name="cidade_comarca_id" id="cidade_comarca_id" class="w-full rounded-md border-slate-300" required>
            <option value="">Selecione</option>
            @foreach ($cidades as $cidade)
                <option value="{{ $cidade->id }}" @selected(old('cidade_comarca_id', $eq?->cidade_comarca_id) == $cidade->id)>{{ $cidade->nome }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm mb-1">Vara</label>
        <select name="vara_id" id="vara_id" class="w-full rounded-md border-slate-300">
            <option value="">Selecione</option>
            @foreach ($varas as $vara)
                <option value="{{ $vara->id }}" data-cidade="{{ $vara->cidade_comarca_id }}" @selected(old('vara_id', $eq?->vara_id) == $vara->id)>{{ $vara->nome }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm mb-1">Setor</label>
        <select name="setor_id" class="w-full rounded-md border-slate-300">
            <option value="">Selecione</option>
            @foreach ($setores as $setor)
                <option value="{{ $setor->id }}" @selected(old('setor_id', $eq?->setor_id) == $setor->id)>{{ $setor->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm mb-1">Observacoes</label>
        <textarea name="observacoes" rows="4" class="w-full rounded-md border-slate-300">{{ old('observacoes', $eq?->observacoes) }}</textarea>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cidade = document.getElementById('cidade_comarca_id');
    const vara = document.getElementById('vara_id');
    const selectedVara = "{{ old('vara_id', $eq?->vara_id) }}";

    async function carregarVaras() {
        const cidadeId = cidade.value;
        const previous = vara.value;
        vara.innerHTML = '<option value="">Selecione</option>';
        if (!cidadeId) return;
        const response = await fetch(`/api/cidades-comarcas/${cidadeId}/varas`);
        const data = await response.json();
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.nome;
            if (String(item.id) === String(selectedVara) || String(item.id) === String(previous)) {
                option.selected = true;
            }
            vara.appendChild(option);
        });
    }

    cidade.addEventListener('change', carregarVaras);
    carregarVaras();

    const codigoInput = document.getElementById('codigo_patrimonio');
    const feedback = document.getElementById('codigo-duplicado-feedback');
    const editingId = "{{ $eq?->id }}";

    async function verificarDuplicado() {
        const valor = codigoInput.value.trim();
        if (!valor) {
            feedback.classList.add('hidden');
            return;
        }
        const response = await fetch(`/api/equipamentos/verificar-codigo/${encodeURIComponent(valor)}`);
        const data = await response.json();
        if (!data.exists || !data.equipamento || String(data.equipamento.id) === String(editingId)) {
            feedback.classList.add('hidden');
            return;
        }
        feedback.className = 'mt-2 rounded-md border border-amber-300 bg-amber-50 px-3 py-2 text-sm text-amber-800';
        feedback.innerHTML = `Este codigo ja esta cadastrado. <a class="underline" href="/equipamentos/${data.equipamento.id}">Abrir equipamento existente</a>.`;
        feedback.classList.remove('hidden');
    }

    codigoInput?.addEventListener('blur', verificarDuplicado);
});
</script>
