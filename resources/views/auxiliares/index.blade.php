@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $titulo }}</h1>
            <p class="text-slate-500 text-sm mt-1">Gerencie os registros cadastrados</p>
        </div>
        @if(auth()->user()->canEdit())
        <a href="{{ route($rota.'.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Novo registro
        </a>
        @endif
    </div>

    @if($itens->isEmpty())
        <div class="empty-state panel p-12">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <p class="text-slate-500 font-medium">Nenhum registro encontrado</p>
            @if(auth()->user()->canEdit())
            <a href="{{ route($rota.'.create') }}" class="btn-primary mt-4">Cadastrar novo</a>
            @endif
        </div>
    @else
        <div class="hidden md:block panel overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                        <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nome</th>
                        @if ($campoCidade ?? false)
                            <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Cidade/Comarca</th>
                        @endif
                        <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="p-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itens as $item)
                        <tr class="border-b border-slate-100 hover:bg-cyan-50/30 transition-colors">
                            <td class="p-4 font-medium text-slate-900">{{ $item->nome }}</td>
                            @if ($campoCidade ?? false)
                                <td class="p-4 text-slate-600">{{ $item->cidadeComarca?->nome }}</td>
                            @endif
                            <td class="p-4">
                                @if($item->ativo)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Ativo
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Inativo
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route($rota.'.show', $item) }}" class="p-2 rounded-lg text-slate-500 hover:text-cyan-600 hover:bg-cyan-50 transition-all" title="Ver detalhes">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    @if(auth()->user()->canEdit())
                                    <a href="{{ route($rota.'.edit', $item) }}" class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-all" title="Editar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    @if($item->ativo)
                                    <form method="POST" action="{{ route($rota.'.destroy', $item) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja desativar este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg text-slate-500 hover:text-red-600 hover:bg-red-50 transition-all" title="Desativar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="md:hidden space-y-3">
            @foreach ($itens as $item)
                <article class="panel p-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-semibold text-slate-900">{{ $item->nome }}</p>
                            @if ($campoCidade ?? false)
                                <p class="text-sm text-slate-500 mt-1">{{ $item->cidadeComarca?->nome }}</p>
                            @endif
                        </div>
                        @if($item->ativo)
                            <span class="badge badge-emerald">Ativo</span>
                        @else
                            <span class="badge badge-slate">Inativo</span>
                        @endif
                    </div>
                    <div class="mt-3 flex items-center gap-2">
                        <a href="{{ route($rota.'.show', $item) }}" class="text-sm text-cyan-600 hover:text-cyan-800 font-medium">Ver detalhes</a>
                        @if(auth()->user()->canEdit())
                        <span class="text-slate-300">·</span>
                        <a href="{{ route($rota.'.edit', $item) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Editar</a>
                        @if($item->ativo)
                        <span class="text-slate-300">·</span>
                        <form method="POST" action="{{ route($rota.'.destroy', $item) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja desativar este registro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Desativar</button>
                        </form>
                        @endif
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif

    @if($itens->hasPages())
    <div class="flex justify-center">
        {{ $itens->links() }}
    </div>
    @endif
</div>
@endsection