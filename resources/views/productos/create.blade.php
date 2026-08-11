@extends('layouts.app')

@section('titulo', 'Nuevo producto — Tienda de Negocios')

@section('contenido')
    <h1 class="text-2xl font-semibold">Nuevo producto</h1>
    <p class="mt-1 text-sm text-black/60 dark:text-white/60">Completá los datos del producto a cargar.</p>

    <form method="POST" action="{{ route('productos.store') }}" class="mt-6 max-w-lg">
        @csrf
        @include('productos._form')
    </form>
@endsection
