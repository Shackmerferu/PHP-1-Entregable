<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Producto;

class ProductoController {
    public function listar(): void {
        $productos = [
            new Producto(1, "Remera Básica", "Algodón 100%", 25, 50, "Ropa", "👕"),
            new Producto(2, "Zapatillas", "Calzado running", 120, 20, "Ropa", "👟"),
            new Producto(3, "Auriculares", "Sonido envolvente", 85, 15, "Electrónica", "🎧"),
            new Producto(4, "Teclado", "Mecánico RGB", 45, 10, "Periféricos", "⌨️"),
            new Producto(5, "Mouse", "Óptico inalámbrico", 25, 15, "Periféricos", "🖱️"),
            new Producto(6, "Smartphone", "Pantalla 6.5", 350, 0, "Electrónica", "📱"),
        ];

        require_once __DIR__ . '/../Views/listar_productos.php';
    }
}
