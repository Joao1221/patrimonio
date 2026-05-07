@php
    $eq = $equipamento ?? null;
@endphp
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
            Tipo <span class="text-red-500">*</span>
        </label>
        <select name="tipo_equipamento_id" class="w-full rounded-lg border-slate-200" required>
            <option value="">Selecione</option>
            @foreach ($tipos as $tipo)
                <option value="{{ $tipo->id }}" @selected(old('tipo_equipamento_id', $eq?->tipo_equipamento_id) == $tipo->id)>{{ $tipo->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
            Código patrimônio <span class="text-red-500">*</span>
        </label>
        <div class="flex gap-2">
            <input id="codigo_patrimonio" type="text" name="codigo_patrimonio" class="flex-1 rounded-lg border-slate-200" value="{{ old('codigo_patrimonio', $eq?->codigo_patrimonio ?? ($codigo_patrimonio ?? '')) }}" placeholder="Digite o código" required>
            <button type="button" data-open-scanner data-target-input="codigo_patrimonio" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                Ler código
            </button>
        </div>
        <div id="codigo-duplicado-feedback" class="hidden rounded-lg border px-4 py-3 text-sm flex items-start gap-2"></div>
    </div>
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
            Marca
        </label>
        <select name="marca_id" class="w-full rounded-lg border-slate-200">
            <option value="">Selecione</option>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}" @selected(old('marca_id', $eq?->marca_id) == $marca->id)>{{ $marca->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Modelo
        </label>
        <input type="text" name="modelo" maxlength="150" class="w-full rounded-lg border-slate-200" value="{{ old('modelo', $eq?->modelo) }}" placeholder="Digite o modelo">
    </div>
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Cidade/Comarca <span class="text-red-500">*</span>
        </label>
        <select name="cidade_comarca_id" id="cidade_comarca_id" class="w-full rounded-lg border-slate-200" required>
            <option value="">Selecione</option>
            @foreach ($cidades as $cidade)
                <option value="{{ $cidade->id }}" @selected(old('cidade_comarca_id', $eq?->cidade_comarca_id) == $cidade->id)>{{ $cidade->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            Vara
        </label>
        <select name="vara_id" id="vara_id" class="w-full rounded-lg border-slate-200">
            <option value="">Selecione</option>
            @foreach ($varas as $vara)
                <option value="{{ $vara->id }}" data-cidade="{{ $vara->cidade_comarca_id }}" @selected(old('vara_id', $eq?->vara_id) == $vara->id)>{{ $vara->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            Setor
        </label>
        <select name="setor_id" class="w-full rounded-lg border-slate-200">
            <option value="">Selecione</option>
            @foreach ($setores as $setor)
                <option value="{{ $setor->id }}" @selected(old('setor_id', $eq?->setor_id) == $setor->id)>{{ $setor->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2 space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Observações
        </label>
        <textarea name="observacoes" rows="3" class="w-full rounded-lg border-slate-200" placeholder="Digite as observações">{{ old('observacoes', $eq?->observacoes) }}</textarea>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const baseUrl = `{{ rtrim(request()->getSchemeAndHttpHost() . request()->getBasePath(), '/') }}`;
    const cidade = document.getElementById('cidade_comarca_id');
    const vara = document.getElementById('vara_id');
    const selectedVara = "{{ old('vara_id', $eq?->vara_id) }}";

    async function carregarVaras() {
        const cidadeId = cidade.value;
        const previous = vara.value;
        vara.innerHTML = '<option value="">Selecione</option>';
        if (!cidadeId) return;
        const response = await fetch(`${baseUrl}/api/cidades-comarcas/${cidadeId}/varas`);
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
        const response = await fetch(`${baseUrl}/api/equipamentos/verificar-codigo/${encodeURIComponent(valor)}`);
        const data = await response.json();
        if (!data.exists || !data.equipamento || String(data.equipamento.id) === String(editingId)) {
            feedback.classList.add('hidden');
            return;
        }
        feedback.className = 'rounded-lg border border-amber-300 bg-amber-50 px-4 py-3 text-sm flex items-start gap-2 text-amber-800';
        feedback.innerHTML = `<svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg><div>Este código já está cadastrado na cidade: <strong>${data.equipamento.cidade_comarca?.nome || 'Desconhecida'}</strong>. <a class="underline font-medium" href="/equipamentos/${data.equipamento.id}">Abrir equipamento</a>.</div>`;
        feedback.classList.remove('hidden');
    }

    codigoInput?.addEventListener('blur', verificarDuplicado);
});
</script>