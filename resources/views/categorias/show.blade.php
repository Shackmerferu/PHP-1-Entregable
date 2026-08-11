@extends('layouts.app')

@section('titulo', $categoria->nombre . ' — Tienda de Negocios')

@section('contenido')
    <a href="{{ route('categorias.index') }}" class="text-sm text-black/60 hover:underline dark:text-white/60">← Volver a categorías</a>

    <div class="mt-4">
        <h1 class="text-3xl font-semibold">{{ $categoria->nombre }}</h1>
        <p class="mt-1 text-sm text-black/60 dark:text-white/60">{{ $categoria->descripcion }}</p>
        <a href="{{ route('categorias.edit', $categoria) }}" class="mt-4 inline-block rounded-lg border border-black/15 px-3 py-1.5 text-xs font-medium hover:bg-black/5 dark:border-white/15 dark:hover:bg-white/10">Editar categoría</a>
    </div>

    <div class="mt-8">
        <h2 class="text-lg font-semibold">Productos ({{ $categoria->productos->count() }})</h2>

        @if ($categoria->productos->isEmpty())
            <p class="mt-4 rounded-lg border border-dashed border-black/20 p-8 text-center text-sm text-black/50 dark:border-white/20 dark:text-white/50">
                Esta categoría todavía no tiene productos.
            </p>
        @else
            <ul class="mt-4 divide-y divide-black/5 dark:divide-white/10">
                @foreach ($categoria->productos as $producto)
                    <li class="flex items-center justify-between py-3">
                        <div>
                            <a href="{{ route('productos.show', $producto) }}" class="font-medium hover:underline">{{ $producto->nombre }}</a>
                            <p class="text-xs text-black/50 dark:text-white/50">{{ $producto->estado }}</p>
                        </div>
                        <span class="text-sm font-semibold">${{ number_format((float) $producto->precio, 2, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
