<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Categoria;
use App\Models\Producto;

class ProductoController
{
    /**
     * Muestra el listado paginado de productos con su categoría.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(9);

        return view('productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario de alta de un producto.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('productos.create', compact('categorias'));
    }

    /**
     * Persiste un nuevo producto validado con StoreProductRequest.
     */
    public function store(StoreProductRequest $request)
    {
        Producto::create($request->validated());

        return redirect()->route('productos.index')
            ->with('ok', 'Producto creado correctamente.');
    }

    /**
     * Muestra el detalle de un producto.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Muestra el formulario de edición de un producto.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();

        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualiza un producto validado con UpdateProductRequest.
     */
    public function update(UpdateProductRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        return redirect()->route('productos.index')
            ->with('ok', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('ok', 'Producto eliminado correctamente.');
    }
}
