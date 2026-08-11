@extends('layouts.app')

@section('titulo', 'Productos — Tienda de Negocios')

@section('contenido')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold">Productos</h1>
            <p class="mt-1 text-sm text-black/60 dark:text-white/60">{{ $productos->total() }} productos en total.</p>
        </div>
        <a href="{{ route('productos.create') }}" class="rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:opacity-80 dark:bg-white dark:text-black">+ Nuevo producto</a>
    </div>

    @if ($productos->isEmpty())
        <p class="rounded-lg border border-dashed border-black/20 p-10 text-center text-sm text-black/50 dark:border-white/20 dark:text-white/50">
            Todavía no hay productos. <a href="{{ route('productos.create') }}" class="underline">Creá el primero</a>.
        </p>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($productos as $producto)
                @include('productos._card', ['producto' => $producto])
            @endforeach
        </div>
    @endif

    <div class="mt-8">
        {{ $productos->links() }}
    </div>
@endsection
