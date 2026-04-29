@extends('layouts.app')

@section('content')
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">{{ $titulo }}</h1>
        <a href="{{ route($rota.'.create') }}" class="btn-primary">Novo</a>
    </div>

    <div class="panel overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left bg-slate-50 border-b">
                    <th class="p-3">Nome</th>
                    @if ($campoCidade ?? false)
                        <th class="p-3">Cidade/Comarca</th>
                    @endif
                    <th class="p-3">Ativo</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($itens as $item)
                    <tr class="border-b">
                        <td class="p-3">{{ $item->nome }}</td>
                        @if ($campoCidade ?? false)
                            <td class="p-3">{{ $item->cidadeComarca?->nome }}</td>
                        @endif
                        <td class="p-3">{{ $item->ativo ? 'Sim' : 'Nao' }}</td>
                        <td class="p-3 text-right space-x-2">
                            <a class="text-blue-600" href="{{ route($rota.'.show', $item) }}">Ver</a>
                            <a class="text-indigo-600" href="{{ route($rota.'.edit', $item) }}">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-3 text-slate-500">Nenhum registro.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $itens->links() }}
</div>
@endsection
