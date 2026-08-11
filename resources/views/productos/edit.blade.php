@extends('layouts.app')

@section('titulo', 'Editar producto — Tienda de Negocios')

@section('contenido')
    <h1 class="text-2xl font-semibold">Editar producto</h1>
    <p class="mt-1 text-sm text-black/60 dark:text-white/60">Modificá los datos de <strong>{{ $producto->nombre }}</strong>.</p>

    <form method="POST" action="{{ route('productos.update', $producto) }}" class="mt-6 max-w-lg">
        @csrf
        @method('PUT')
        @include('productos._form')
    </form>
@endsection
