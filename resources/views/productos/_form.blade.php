@php $producto = $producto ?? null; @endphp

<div class="space-y-5">
    <div>
        <label for="nombre" class="block text-sm font-medium">Nombre</label>
        <input id="nombre" name="nombre" value="{{ old('nombre', $producto?->nombre) }}" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">
        @error('nombre')
            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="descripcion" class="block text-sm font-medium">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="3" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">{{ old('descripcion', $producto?->descripcion) }}</textarea>
        @error('descripcion')
            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="precio" class="block text-sm font-medium">Precio</label>
            <input id="precio" name="precio" type="number" step="0.01" min="0" value="{{ old('precio', $producto?->precio) }}" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">
            @error('precio')
                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock" class="block text-sm font-medium">Stock</label>
            <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $producto?->stock) }}" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">
            @error('stock')
                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="imagen" class="block text-sm font-medium">Imagen (URL)</label>
        <input id="imagen" name="imagen" type="url" value="{{ old('imagen', $producto?->imagen) }}" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">
        @error('imagen')
            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="estado" class="block text-sm font-medium">Estado</label>
            <select id="estado" name="estado" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">
                <option value="{{ \App\Models\Producto::ESTADO_DISPONIBLE }}" @selected(old('estado', $producto?->estado) === \App\Models\Producto::ESTADO_DISPONIBLE)>Disponible</option>
                <option value="{{ \App\Models\Producto::ESTADO_AGOTADO }}" @selected(old('estado', $producto?->estado) === \App\Models\Producto::ESTADO_AGOTADO)>Agotado</option>
            </select>
            @error('estado')
                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="categoria_id" class="block text-sm font-medium">Categoría</label>
            <select id="categoria_id" name="categoria_id" class="mt-1 w-full rounded-lg border border-black/15 bg-transparent px-3 py-2 text-sm focus:border-black focus:outline-none dark:border-white/15">
                <option value="">Elegí una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected(old('categoria_id', $producto?->categoria_id) == $categoria->id)>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
            @error('categoria_id')
                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <button class="rounded-lg bg-black px-5 py-2 text-sm font-medium text-white hover:opacity-80 dark:bg-white dark:text-black">Guardar producto</button>
</div>
