<?php

namespace App\Http\Controllers;

use App\Models\CarritoItem;
use App\Models\User;
use Illuminate\Http\Request;

class CarritoController
{
    /**
     * Muestra el carrito del usuario actual con su total.
     */
    public function index()
    {
        $usuario = $this->usuarioActual();

        $items = $usuario->carritoItems()
            ->with('producto.categoria')
            ->get();

        $total = $items->sum(fn ($item) => $item->producto->precio * $item->cantidad);

        return view('carrito.index', compact('items', 'total'));
    }

    /**
     * Agrega un producto al carrito. Si ya existe, incrementa la cantidad.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'producto_id' => ['required', 'exists:productos,id'],
            'cantidad' => ['required', 'integer', 'min:1'],
        ]);

        $item = CarritoItem::firstOrNew([
            'user_id' => $this->usuarioActual()->id,
            'producto_id' => $datos['producto_id'],
        ]);

        $item->cantidad = ($item->cantidad ?? 0) + $datos['cantidad'];
        $item->save();

        return redirect()->route('carrito.index')
            ->with('ok', 'Producto agregado al carrito.');
    }

    /**
     * Actualiza la cantidad de un item del carrito.
     */
    public function update(Request $request, CarritoItem $carrito)
    {
        $datos = $request->validate([
            'cantidad' => ['required', 'integer', 'min:1'],
        ]);

        $carrito->update($datos);

        return redirect()->route('carrito.index')
            ->with('ok', 'Cantidad actualizada.');
    }

    /**
     * Elimina un item del carrito.
     */
    public function destroy(CarritoItem $carrito)
    {
        $carrito->delete();

        return redirect()->route('carrito.index')
            ->with('ok', 'Producto quitado del carrito.');
    }

    /**
     * Devuelve el usuario autenticado o un usuario demo de respaldo.
     */
    private function usuarioActual(): User
    {
        return auth()->user() ?? User::query()->firstOrCreate(
            ['email' => 'demo@tienda.test'],
            ['name' => 'Usuario Demo', 'password' => 'password']
        );
    }
}
