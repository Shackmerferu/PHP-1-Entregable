<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Tienda de Negocios')</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-[#FDFDFC] text-[#1b1b18] antialiased dark:bg-[#0a0a0a] dark:text-[#EDEDEC]">
    @php
        $usuarioId = auth()->id() ?? optional(\App\Models\User::query()->first())->id;
        $cantidadCarrito = $usuarioId ? \App\Models\CarritoItem::where('user_id', $usuarioId)->sum('cantidad') : 0;
    @endphp

    <header class="border-b border-black/5 dark:border-white/10">
        <nav class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
            <a href="{{ route('productos.index') }}" class="text-lg font-semibold tracking-tight">Tienda de Negocios 🎍</a>
            <div class="flex items-center gap-5 text-sm">
                <a href="{{ route('productos.index') }}" class="hover:underline">Productos</a>
                <a href="{{ route('categorias.index') }}" class="hover:underline">Categorías</a>
                <a href="{{ route('carrito.index') }}" class="flex items-center gap-1.5 hover:underline">
                    Carrito
                    <span class="rounded-full bg-black px-2 py-0.5 text-xs font-medium text-white dark:bg-white dark:text-black">{{ $cantidadCarrito }}</span>
                </a>
            </div>
        </nav>
    </header>

    <main class="mx-auto w-full max-w-5xl flex-1 px-6 py-8">
        @if (session('ok'))
            <div class="mb-6 rounded-lg border border-green-600/30 bg-green-600/10 px-4 py-3 text-sm text-green-800 dark:text-green-300">
                {{ session('ok') }}
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer class="border-t border-black/5 py-6 text-center text-xs text-black/50 dark:border-white/10 dark:text-white/50">
        PHP &amp; Laravel · Entrega 2 — Tienda de Negocios
    </footer>
</body>
</html>
