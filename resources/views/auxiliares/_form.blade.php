<div class="space-y-5">
    @if ($campoCidade ?? false)
        <div class="space-y-2">
            <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Cidade/Comarca <span class="text-red-500">*</span>
            </label>
            <select name="cidade_comarca_id" class="w-full rounded-lg border-slate-200" required>
                <option value="">Selecione</option>
                @foreach ($cidades as $cidade)
                    <option value="{{ $cidade->id }}" @selected(old('cidade_comarca_id', $item->cidade_comarca_id ?? null) == $cidade->id)>{{ $cidade->nome }}</option>
                @endforeach
            </select>
        </div>
    @endif
    <div class="space-y-2">
        <label class="text-sm font-semibold text-slate-700 flex items-center gap-1">
            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Nome <span class="text-red-500">*</span>
        </label>
        <input type="text" name="nome" class="w-full rounded-lg border-slate-200" value="{{ old('nome', $item->nome ?? '') }}" placeholder="Digite o nome" required>
    </div>
    <div class="flex items-center gap-3 p-4 rounded-xl bg-slate-50 border border-slate-200">
        <input type="checkbox" name="ativo" id="ativo" value="1" class="w-5 h-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" @checked(old('ativo', $item->ativo ?? true))>
        <label for="ativo" class="text-sm font-medium text-slate-700">Registro ativo</label>
    </div>
</div>