@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <a href="{{ route('equipamentos.levantamento') }}" class="btn-primary">Ir para levantamento em lote</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <article class="panel p-4 relative overflow-hidden">
            <div class="absolute -top-8 -right-10 h-24 w-24 rounded-full bg-cyan-200/50 blur-xl"></div>
            <p class="text-sm text-slate-500">Total de equipamentos</p>
            <p class="text-3xl font-extrabold mt-1 text-slate-900">{{ $totalEquipamentos }}</p>
        </article>
        <article class="panel p-4 md:col-span-2">
            <h2 class="font-semibold mb-2">Total por tipo</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm">
                @foreach ($totaisPorTipo as $item)
                    <div class="panel-soft px-3 py-2">{{ $item->nome }}: <strong class="text-cyan-900">{{ $item->equipamentos_count }}</strong></div>
                @endforeach
            </div>
        </article>
    </div>

    <article class="panel p-4">
        <h2 class="font-semibold mb-2">Total por cidade/comarca</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
            @foreach ($totaisPorCidade as $item)
                <div class="panel-soft px-3 py-2">{{ $item->nome }}: <strong class="text-cyan-900">{{ $item->equipamentos_count }}</strong></div>
            @endforeach
        </div>
    </article>

    <article class="panel p-4">
        <h2 class="font-semibold mb-2">Ultimos cadastrados</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-2">Codigo</th>
                        <th>Tipo</th>
                        <th>Cidade</th>
                        <th>Setor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ultimosEquipamentos as $eq)
                        <tr class="border-b last:border-0">
                            <td class="py-2">{{ $eq->codigo_patrimonio }}</td>
                            <td>{{ $eq->tipoEquipamento?->nome }}</td>
                            <td>{{ $eq->cidadeComarca?->nome }}</td>
                            <td>{{ $eq->setor?->nome }}</td>
                            <td><a class="text-blue-600 hover:underline" href="{{ route('equipamentos.show', $eq) }}">Abrir</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-3 text-slate-500">Sem equipamentos cadastrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </article>
</div>
@endsection
