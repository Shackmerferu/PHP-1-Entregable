<article class="flex flex-col rounded-xl border border-black/10 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-white/5">
    <div class="flex items-start justify-between gap-3">
        <h2 class="text-lg font-semibold leading-snug">{{ $producto->nombre }}</h2>
        <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-medium {{ $producto->estado === \App\Models\Producto::ESTADO_DISPONIBLE ? 'bg-green-600/15 text-green-700 dark:text-green-300' : 'bg-red-600/15 text-red-700 dark:text-red-300' }}">
            {{ $producto->estado }}
        </span>
    </div>

    <p class="mt-2 text-xs uppercase tracking-wide text-black/40 dark:text-white/40">{{ $producto->categoria?->nombre ?? 'Sin categoría' }}</p>
    <p class="mt-3 flex-1 text-sm leading-relaxed text-black/70 dark:text-white/70">{{ $producto->descripcion }}</p>

    <div class="mt-4 flex items-center justify-between border-t border-black/5 pt-4 dark:border-white/10">
        <span class="text-lg font-semibold">${{ number_format((float) $producto->precio, 2, ',', '.') }}</span>
        <div class="flex items-center gap-2">
            <a href="{{ route('productos.show', $producto) }}" class="rounded-lg border border-black/15 px-3 py-1.5 text-xs font-medium hover:bg-black/5 dark:border-white/15 dark:hover:bg-white/10">Ver</a>
            @if ($producto->stock > 0)
                <form method="POST" action="{{ route('carrito.store') }}">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    <input type="hidden" name="cantidad" value="1">
                    <button class="rounded-lg bg-black px-3 py-1.5 text-xs font-medium text-white hover:opacity-80 dark:bg-white dark:text-black">Agregar</button>
                </form>
            @endif
        </div>
    </div>
</article>
