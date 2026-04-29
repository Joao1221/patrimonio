@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <div class="flex flex-wrap gap-2 items-center justify-between">
        <h1 class="text-2xl font-bold">Equipamentos</h1>
        <div class="flex gap-2">
            <button type="button" id="consultar-camera" data-open-scanner data-target-input="filtro_codigo_camera" class="btn-secondary">Consultar pela camera</button>
            <a href="{{ route('equipamentos.levantamento') }}" class="btn-muted">Levantamento</a>
            <a href="{{ route('equipamentos.create') }}" class="btn-primary">Novo cadastro</a>
        </div>
    </div>

    <form method="GET" class="panel p-4 grid grid-cols-1 md:grid-cols-6 gap-3">
        <input id="filtro_codigo_camera" name="codigo_patrimonio" value="{{ $filters['codigo_patrimonio'] ?? '' }}" placeholder="Buscar por codigo" class="rounded-md border-slate-300 md:col-span-2">
        <select name="tipo_equipamento_id" class="rounded-md border-slate-300">
            <option value="">Tipo</option>
            @foreach ($tipos as $item)
                <option value="{{ $item->id }}" @selected(($filters['tipo_equipamento_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
            @endforeach
        </select>
        <select name="marca_id" class="rounded-md border-slate-300">
            <option value="">Marca</option>
            @foreach ($marcas as $item)
                <option value="{{ $item->id }}" @selected(($filters['marca_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
            @endforeach
        </select>
        <select name="cidade_comarca_id" class="rounded-md border-slate-300">
            <option value="">Cidade</option>
            @foreach ($cidades as $item)
                <option value="{{ $item->id }}" @selected(($filters['cidade_comarca_id'] ?? '') == $item->id)>{{ $item->nome }}</option>
            @endforeach
        </select>
        <button class="btn-secondary">Filtrar</button>
    </form>

    <div class="space-y-3 md:hidden">
        @forelse ($equipamentos as $eq)
            <article class="panel p-4">
                <p class="font-semibold">{{ $eq->codigo_patrimonio }}</p>
                <p class="text-sm text-slate-600">{{ $eq->tipoEquipamento?->nome }} | {{ $eq->cidadeComarca?->nome }}</p>
                <a href="{{ route('equipamentos.show', $eq) }}" class="text-blue-600 text-sm mt-2 inline-block">Ver detalhes</a>
            </article>
        @empty
            <p class="text-slate-500">Nenhum equipamento encontrado.</p>
        @endforelse
    </div>

    <div class="hidden md:block panel overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b text-left bg-slate-50">
                    <th class="p-3">Codigo</th><th class="p-3">Tipo</th><th class="p-3">Marca</th><th class="p-3">Cidade</th><th class="p-3">Setor</th><th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipamentos as $eq)
                    <tr class="border-b">
                        <td class="p-3">{{ $eq->codigo_patrimonio }}</td>
                        <td class="p-3">{{ $eq->tipoEquipamento?->nome }}</td>
                        <td class="p-3">{{ $eq->marca?->nome }}</td>
                        <td class="p-3">{{ $eq->cidadeComarca?->nome }}</td>
                        <td class="p-3">{{ $eq->setor?->nome }}</td>
                        <td class="p-3"><a class="text-blue-600" href="{{ route('equipamentos.show', $eq) }}">Abrir</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $equipamentos->links() }}
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('filtro_codigo_camera');
    input?.addEventListener('blur', async () => {
        const codigo = input.value.trim();
        if (!codigo) return;
        const resp = await fetch(`/api/equipamentos/buscar-por-codigo/${encodeURIComponent(codigo)}`);
        if (resp.ok) {
            const equipamento = await resp.json();
            window.location.href = `/equipamentos/${equipamento.id}`;
            return;
        }
        if (confirm('Equipamento nao encontrado. Deseja cadastra-lo com este codigo?')) {
            window.location.href = `/equipamentos/create?codigo_patrimonio=${encodeURIComponent(codigo)}`;
        }
    });
});
</script>
@endsection
