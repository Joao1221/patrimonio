@extends('layouts.app')

@section('content')
<div class="panel p-4 space-y-4">
    <h1 class="text-2xl font-bold">Novo equipamento</h1>
    <form method="POST" action="{{ route('equipamentos.store') }}" class="space-y-4">
        @csrf
        @include('equipamentos._form')
        <div class="flex gap-2">
            <button class="btn-primary">Salvar</button>
            <a href="{{ route('equipamentos.index') }}" class="btn-muted">Cancelar</a>
        </div>
    </form>
</div>
@endsection
