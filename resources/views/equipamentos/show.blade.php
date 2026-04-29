@extends('layouts.app')

@section('content')
<div class="panel p-4 space-y-4">
    <div class="flex flex-wrap items-center justify-between gap-2">
        <h1 class="text-2xl font-bold">Detalhes do equipamento</h1>
        <div class="flex gap-2">
            <a href="{{ route('equipamentos.edit', $equipamento) }}" class="btn-primary">Editar</a>
            <a href="{{ route('equipamentos.index') }}" class="btn-muted">Voltar</a>
        </div>
    </div>

    <dl class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
        <div><dt class="text-slate-500">Codigo patrimonio</dt><dd class="font-semibold">{{ $equipamento->codigo_patrimonio }}</dd></div>
        <div><dt class="text-slate-500">Tipo</dt><dd>{{ $equipamento->tipoEquipamento?->nome }}</dd></div>
        <div><dt class="text-slate-500">Marca</dt><dd>{{ $equipamento->marca?->nome ?? '-' }}</dd></div>
        <div><dt class="text-slate-500">Modelo</dt><dd>{{ $equipamento->modelo ?? '-' }}</dd></div>
        <div><dt class="text-slate-500">Cidade/Comarca</dt><dd>{{ $equipamento->cidadeComarca?->nome }}</dd></div>
        <div><dt class="text-slate-500">Vara</dt><dd>{{ $equipamento->vara?->nome ?? '-' }}</dd></div>
        <div><dt class="text-slate-500">Setor</dt><dd>{{ $equipamento->setor?->nome ?? '-' }}</dd></div>
        <div><dt class="text-slate-500">Data de cadastro</dt><dd>{{ $equipamento->created_at?->format('d/m/Y H:i') }}</dd></div>
        <div><dt class="text-slate-500">Ultima atualizacao</dt><dd>{{ $equipamento->updated_at?->format('d/m/Y H:i') }}</dd></div>
        <div class="md:col-span-2"><dt class="text-slate-500">Observacoes</dt><dd>{{ $equipamento->observacoes ?: '-' }}</dd></div>
    </dl>
</div>
@endsection
