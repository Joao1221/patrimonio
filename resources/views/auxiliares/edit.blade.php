@extends('layouts.app')

@section('content')
<div class="panel p-4 space-y-4">
    <h1 class="text-2xl font-bold">{{ $titulo }}</h1>
    <form method="POST" action="{{ route($rota.'.update', $item) }}" class="space-y-4">
        @csrf
        @method('PUT')
        @include('auxiliares._form')
        <div class="flex gap-2">
            <button class="btn-primary">Salvar alteracoes</button>
            <a href="{{ route($rota.'.index') }}" class="btn-muted">Voltar</a>
        </div>
    </form>
</div>
@endsection
