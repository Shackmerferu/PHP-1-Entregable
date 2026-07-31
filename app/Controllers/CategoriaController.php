<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class CategoriaController {
    public function mostrarCategoria(): void {
        $ropa = new Categoria(1, "Ropa");
        $ropa->agregarProducto(new Producto(1, "Remera Básica", "Algodón 100%", 25, 50, "Ropa", "👕"));
        $ropa->agregarProducto(new Producto(2, "Zapatillas", "Calzado running", 120, 20, "Ropa", "👟"));

        $electronica = new Categoria(2, "Electrónica");
        $electronica->agregarProducto(new Producto(3, "Auriculares", "Sonido envolvente", 85, 15, "Electrónica", "🎧"));
        $electronica->agregarProducto(new Producto(6, "Smartphone", "Pantalla 6.5", 350, 0, "Electrónica", "📱"));

        $perifericos = new Categoria(3, "Periféricos");
        $perifericos->agregarProducto(new Producto(4, "Teclado", "Mecánico RGB", 45, 10, "Periféricos", "⌨️"));
        $perifericos->agregarProducto(new Producto(5, "Mouse", "Óptico inalámbrico", 25, 15, "Periféricos", "🖱️"));

        $categoriaObjetos = [$ropa, $electronica, $perifericos];
        $categorias = array_map(fn (Categoria $categoria) => $categoria->getNombre(), $categoriaObjetos);

        $categoriaSeleccionada = $_GET['categoria'] ?? 'Todas';
        if (!in_array($categoriaSeleccionada, $categorias, true)) {
            $categoriaSeleccionada = 'Todas';
        }

        $productos = [];
        foreach ($categoriaObjetos as $categoria) {
            if ($categoriaSeleccionada === 'Todas' || $categoria->getNombre() === $categoriaSeleccionada) {
                foreach ($categoria->obtenerProductos() as $producto) {
                    $productos[] = $producto;
                }
            }
        }

        require_once __DIR__ . '/../Views/vista_categoria.php';
    }
}
