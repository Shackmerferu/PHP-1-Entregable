@extends('layouts.app')

@section('titulo', 'Editar categoría — Tienda de Negocios')

@section('contenido')
    <h1 class="text-2xl font-semibold">Editar categoría</h1>
    <p class="mt-1 text-sm text-black/60 dark:text-white/60">Modificá los datos de <strong>{{ $categoria->nombre }}</strong>.</p>

    <form method="POST" action="{{ route('categorias.update', $categoria) }}" class="mt-6 max-w-lg space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre" class="block text-sm font-medium">Nombre</label>
            <input id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">
            @error('nombre')
                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="3" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            @error('descripcion')
                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button class="rounded-lg bg-black px-5 py-2 text-sm font-medium text-white hover:opacity-80 dark:bg-white dark:text-black">Actualizar categoría</button>
    </form>
@endsection
