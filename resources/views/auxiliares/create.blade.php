@extends('layouts.app')

@section('title', 'Novo ' . $tituloSingular)

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Novo {{ $tituloSingular }}</h1>
        <p class="text-slate-500 text-sm mt-1">Preencha os dados para cadastrar</p>
    </div>

    <form method="POST" action="{{ route($rota.'.store') }}" class="panel p-5 space-y-5">
        @csrf
        @include('auxiliares._form', ['item' => null])
        <div class="flex gap-3 pt-4 border-t border-slate-200">
            <button class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Salvar
            </button>
            <a href="{{ route($rota.'.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection