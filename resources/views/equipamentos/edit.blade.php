@extends('layouts.app')

@section('title', 'Editar Equipamento')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Editar equipamento</h1>
        <p class="text-slate-500 text-sm mt-1">Altere os dados do equipamento</p>
    </div>

    <form method="POST" action="{{ route('equipamentos.update', $equipamento) }}" class="panel p-5 space-y-5">
        @csrf
        @method('PUT')
        @include('equipamentos._form')
        <div class="flex gap-3 pt-4 border-t border-slate-200">
            <button class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Salvar alterações
            </button>
            <a href="{{ route('equipamentos.show', $equipamento) }}" class="btn-secondary">Voltar</a>
        </div>
    </form>
</div>
@endsection