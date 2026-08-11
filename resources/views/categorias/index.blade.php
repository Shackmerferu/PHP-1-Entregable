@extends('layouts.app')

@section('titulo', 'Categorías — Tienda de Negocios')

@section('contenido')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold">Categorías</h1>
            <p class="mt-1 text-sm text-black/60 dark:text-white/60">{{ $categorias->count() }} categorías cargadas.</p>
        </div>
        <a href="{{ route('categorias.create') }}" class="rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:opacity-80 dark:bg-white dark:text-black">+ Nueva categoría</a>
    </div>

    @if ($categorias->isEmpty())
        <p class="rounded-lg border border-dashed border-black/20 p-10 text-center text-sm text-black/50 dark:border-white/20 dark:text-white/50">
            Todavía no hay categorías.
        </p>
    @else
        <div class="overflow-hidden rounded-xl border border-black/10 dark:border-white/10">
            <table class="w-full text-left text-sm">
                <thead class="bg-black/5 dark:bg-white/5">
                    <tr>
                        <th class="px-4 py-3 font-medium">Nombre</th>
                        <th class="px-4 py-3 font-medium">Descripción</th>
                        <th class="px-4 py-3 text-center font-medium">Productos</th>
                        <th class="px-4 py-3 text-right font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/10">
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $categoria->nombre }}</td>
                            <td class="px-4 py-3 text-black/60 dark:text-white/60">{{ $categoria->descripcion }}</td>
                            <td class="px-4 py-3 text-center">{{ $categoria->productos_count }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2 text-xs">
                                    <a href="{{ route('categorias.show', $categoria) }}" class="rounded-lg border border-black/15 px-3 py-1.5 font-medium hover:bg-black/5 dark:border-white/15 dark:hover:bg-white/10">Ver</a>
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="rounded-lg border border-black/15 px-3 py-1.5 font-medium hover:bg-black/5 dark:border-white/15 dark:hover:bg-white/10">Editar</a>
                                    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('¿Eliminar esta categoría y sus productos?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-lg border border-red-600/40 px-3 py-1.5 font-medium text-red-700 hover:bg-red-600/10 dark:text-red-300">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
