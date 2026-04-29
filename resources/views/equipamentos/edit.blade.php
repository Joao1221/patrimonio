@extends('layouts.app')

@section('content')
<div class="panel p-4 space-y-4">
    <h1 class="text-2xl font-bold">Editar equipamento</h1>
    <form method="POST" action="{{ route('equipamentos.update', $equipamento) }}" class="space-y-4">
        @csrf
        @method('PUT')
        @include('equipamentos._form')
        <div class="flex gap-2">
            <button class="btn-primary">Salvar alteracoes</button>
            <a href="{{ route('equipamentos.show', $equipamento) }}" class="btn-muted">Voltar</a>
        </div>
    </form>
</div>
@endsection
