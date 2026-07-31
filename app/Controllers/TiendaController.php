<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Usuario;

class TiendaController {
    public function mostrarTienda(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $usuario = new Usuario(1, "Ana", "ana@mail.com", Usuario::ROL_ADMIN);

        $productos = [
            new Producto(1, "Remera Básica", "Algodón 100%", 25, 50, "Ropa", "👕"),
            new Producto(2, "Zapatillas", "Calzado running", 120, 20, "Ropa", "👟"),
            new Producto(3, "Auriculares", "Sonido envolvente", 85, 15, "Electrónica", "🎧"),
            new Producto(4, "Teclado", "Mecánico RGB", 45, 10, "Periféricos", "⌨️"),
            new Producto(5, "Mouse", "Óptico inalámbrico", 25, 15, "Periféricos", "🖱️"),
            new Producto(6, "Smartphone", "Pantalla 6.5", 350, 0, "Electrónica", "📱"),
        ];

        $categorias = ['Ropa', 'Electrónica', 'Periféricos'];
        $categoriaSeleccionada = $_GET['categoria'] ?? 'Todas';
        if (!in_array($categoriaSeleccionada, $categorias, true)) {
            $categoriaSeleccionada = 'Todas';
        }

        if ($categoriaSeleccionada !== 'Todas') {
            $productos = array_filter(
                $productos,
                fn (Producto $producto) => $producto->getCategoria() === $categoriaSeleccionada
            );
        }

        $carrito = $_SESSION['carrito'] ?? new Carrito();
        $cantidadItems = $carrito->getCantidadItems();
        $subtotal = $carrito->calcularSubtotal();

        require_once __DIR__ . '/../Views/layout.php';
    }
}
