@extends('layouts.app')

@section('titulo', $producto->nombre . ' — Tienda de Negocios')

@section('contenido')
    <a href="{{ route('productos.index') }}" class="text-sm text-black/60 hover:underline dark:text-white/60">← Volver a productos</a>

    <div class="mt-4 flex flex-col gap-8 lg:flex-row">
        <div class="flex-1">
            <h1 class="text-3xl font-semibold">{{ $producto->nombre }}</h1>
            <p class="mt-1 text-xs uppercase tracking-wide text-black/40 dark:text-white/40">{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</p>

            <span class="mt-4 inline-block rounded-full px-2.5 py-1 text-xs font-medium {{ $producto->estado === \App\Models\Producto::ESTADO_DISPONIBLE ? 'bg-green-600/15 text-green-700 dark:text-green-300' : 'bg-red-600/15 text-red-700 dark:text-red-300' }}">
                {{ $producto->estado }}
            </span>

            <p class="mt-4 leading-relaxed text-black/70 dark:text-white/70">{{ $producto->descripcion }}</p>

            <p class="mt-6 text-2xl font-semibold">${{ number_format((float) $producto->precio, 2, ',', '.') }}</p>
            <p class="mt-1 text-sm text-black/50 dark:text-white/50">
                Stock disponible: {{ $producto->stock }}
            </p>
        </div>

        <aside class="w-full rounded-xl border border-black/10 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-white/5 lg:w-72">
            <h2 class="text-sm font-semibold uppercase tracking-wide">Agregar al carrito</h2>

            @if ($producto->stock > 0)
                <form method="POST" action="{{ route('carrito.store') }}" class="mt-4 space-y-4">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    <label for="cantidad" class="block text-sm font-medium">Cantidad</label>
                    <input id="cantidad" name="cantidad" type="number" min="1" max="{{ $producto->stock }}" value="1" class="w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">
                    <button class="w-full rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:opacity-80 dark:bg-white dark:text-black">Agregar al carrito</button>
                </form>
            @else
                <p class="mt-4 text-sm text-red-700 dark:text-red-300">Este producto está agotado.</p>
            @endif

            <div class="mt-6 flex gap-3 border-t border-black/5 pt-4 dark:border-white/10">
                <a href="{{ route('productos.edit', $producto) }}" class="flex-1 rounded-lg border border-black/15 px-3 py-2 text-center text-sm font-medium hover:bg-black/5 dark:border-white/15 dark:hover:bg-white/10">Editar</a>
                <form method="POST" action="{{ route('productos.destroy', $producto) }}" class="flex-1" onsubmit="return confirm('¿Eliminar este producto?');">
                    @csrf
                    @method('DELETE')
                    <button class="w-full rounded-lg border border-red-600/40 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-600/10 dark:text-red-300">Eliminar</button>
                </form>
            </div>
        </aside>
    </div>
@endsection
