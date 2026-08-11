@extends('layouts.app')

@section('titulo', 'Carrito — Tienda de Negocios')

@section('contenido')
    <h1 class="text-2xl font-semibold">Tu carrito</h1>

    @if ($items->isEmpty())
        <p class="mt-6 rounded-lg border border-dashed border-black/20 p-10 text-center text-sm text-black/50 dark:border-white/20 dark:text-white/50">
            Tu carrito está vacío. <a href="{{ route('productos.index') }}" class="underline">Explorá los productos</a>.
        </p>
    @else
        <div class="mt-6 overflow-hidden rounded-xl border border-black/10 dark:border-white/10">
            <table class="w-full text-left text-sm">
                <thead class="bg-black/5 dark:bg-white/5">
                    <tr>
                        <th class="px-4 py-3 font-medium">Producto</th>
                        <th class="px-4 py-3 text-center font-medium">Cantidad</th>
                        <th class="px-4 py-3 text-right font-medium">Precio unitario</th>
                        <th class="px-4 py-3 text-right font-medium">Subtotal</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/10">
                    @foreach ($items as $item)
                        <tr>
                            <td class="px-4 py-3">
                                <a href="{{ route('productos.show', $item->producto) }}" class="font-medium hover:underline">{{ $item->producto->nombre }}</a>
                                <p class="text-xs text-black/50 dark:text-white/50">{{ $item->producto->categoria?->nombre }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('carrito.update', $item) }}" class="flex items-center justify-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input name="cantidad" type="number" min="1" value="{{ $item->cantidad }}" class="w-16 rounded-lg border border-black/15 bg-transparent px-2 py-1 text-center text-sm focus:border-black focus:outline-none dark:border-white/15">
                                    <button class="rounded-lg border border-black/15 px-2 py-1 text-xs hover:bg-black/5 dark:border-white/15 dark:hover:bg-white/10">Actualizar</button>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-right">${{ number_format((float) $item->producto->precio, 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right font-medium">${{ number_format((float) $item->producto->precio * $item->cantidad, 2, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right">
                                <form method="POST" action="{{ route('carrito.destroy', $item) }}" onsubmit="return confirm('¿Quitar este producto del carrito?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs font-medium text-red-700 hover:underline dark:text-red-300">Quitar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col items-end gap-4">
            <p class="text-lg">
                Total: <strong>${{ number_format((float) $total, 2, ',', '.') }}</strong>
            </p>
            <a href="{{ route('productos.index') }}" class="rounded-lg bg-black px-5 py-2 text-sm font-medium text-white hover:opacity-80 dark:bg-white dark:text-black">Seguir comprando</a>
        </div>
    @endif
@endsection
