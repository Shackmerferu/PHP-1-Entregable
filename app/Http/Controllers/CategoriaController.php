<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController
{
    /**
     * Muestra el listado de categorías con la cantidad de productos.
     */
    public function index()
    {
        $categorias = Categoria::withCount('productos')->get();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Muestra el formulario de alta de una categoría.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Persiste una nueva categoría validando la entrada en línea.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:80', 'unique:categorias,nombre'],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        Categoria::create($datos);

        return redirect()->route('categorias.index')
            ->with('ok', 'Categoría creada correctamente.');
    }

    /**
     * Muestra una categoría con sus productos.
     */
    public function show(Categoria $categoria)
    {
        $categoria->load('productos');

        return view('categorias.show', compact('categoria'));
    }

    /**
     * Muestra el formulario de edición de una categoría.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualiza una categoría validando la entrada en línea.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:80', Rule::unique('categorias', 'nombre')->ignore($categoria->id)],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        $categoria->update($datos);

        return redirect()->route('categorias.index')
            ->with('ok', 'Categoría actualizada correctamente.');
    }

    /**
     * Elimina una categoría.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('ok', 'Categoría eliminada correctamente.');
    }
}
