@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Usuários</h1>
            <p class="text-slate-500 text-sm mt-1">Gerencie os acessos ao sistema</p>
        </div>
        <a href="{{ route('usuarios.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Novo usuário
        </a>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 text-sm font-medium">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 p-4 rounded-xl border border-red-200 bg-red-50 text-red-800 text-sm font-medium">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Desktop --}}
    <div class="hidden md:block panel overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nome</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">E-mail</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Perfil</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Acesso</th>
                    <th class="p-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $usuario)
                    <tr class="border-b border-slate-100 hover:bg-cyan-50/30 transition-colors">
                        <td class="p-4 font-medium text-slate-900">
                            {{ $usuario->name }}
                            @if($usuario->id === auth()->id())
                                <span class="ml-1 text-xs text-slate-400">(você)</span>
                            @endif
                        </td>
                        <td class="p-4 text-slate-600">{{ $usuario->email }}</td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $usuario->papel->badgeClass() }}">
                                {{ $usuario->papel->label() }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if($usuario->verTodasCidades())
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                                    Todas as cidades
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $usuario->cidadeComarca?->nome ?? '—' }}
                                </span>
                            @endif
                        </td>
                        <td class="p-4">
                            @if($usuario->ativo)
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
                                <a href="{{ route('usuarios.edit', $usuario) }}" class="p-2 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-all" title="Editar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                @if($usuario->id !== auth()->id())
                                <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja remover este usuário?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg text-slate-500 hover:text-red-600 hover:bg-red-50 transition-all" title="Remover">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Nenhum usuário encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile --}}
    <div class="md:hidden space-y-3">
        @forelse ($usuarios as $usuario)
            <article class="panel p-4">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <p class="font-semibold text-slate-900">
                            {{ $usuario->name }}
                            @if($usuario->id === auth()->id())
                                <span class="text-xs text-slate-400">(você)</span>
                            @endif
                        </p>
                        <p class="text-sm text-slate-500 mt-0.5">{{ $usuario->email }}</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border flex-shrink-0 {{ $usuario->papel->badgeClass() }}">
                        {{ $usuario->papel->label() }}
                    </span>
                </div>
                <div class="mt-2 flex flex-wrap items-center gap-2">
                    @if($usuario->verTodasCidades())
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800">Todas as cidades</span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700">{{ $usuario->cidadeComarca?->nome }}</span>
                    @endif
                    @if($usuario->ativo)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Ativo</span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">Inativo</span>
                    @endif
                </div>
                <div class="mt-3 flex items-center gap-3">
                    <a href="{{ route('usuarios.edit', $usuario) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Editar</a>
                    @if($usuario->id !== auth()->id())
                        <span class="text-slate-300">·</span>
                        <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="inline" onsubmit="return confirm('Remover este usuário?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Remover</button>
                        </form>
                    @endif
                </div>
            </article>
        @empty
            <div class="panel p-8 text-center text-slate-400">Nenhum usuário encontrado.</div>
        @endforelse
    </div>

    @if($usuarios->hasPages())
    <div class="flex justify-center">{{ $usuarios->links() }}</div>
    @endif
</div>
@endsection
