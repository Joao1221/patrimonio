<div class="space-y-4">
    @if ($campoCidade ?? false)
        <div>
            <label class="block text-sm mb-1">Cidade/Comarca *</label>
            <select name="cidade_comarca_id" class="w-full rounded-md border-slate-300" required>
                <option value="">Selecione</option>
                @foreach ($cidades as $cidade)
                    <option value="{{ $cidade->id }}" @selected(old('cidade_comarca_id', $item->cidade_comarca_id ?? null) == $cidade->id)>{{ $cidade->nome }}</option>
                @endforeach
            </select>
        </div>
    @endif
    <div>
        <label class="block text-sm mb-1">Nome *</label>
        <input type="text" name="nome" class="w-full rounded-md border-slate-300" value="{{ old('nome', $item->nome ?? '') }}" required>
    </div>
    <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="ativo" value="1" @checked(old('ativo', $item->ativo ?? true))>
        Registro ativo
    </label>
</div>
