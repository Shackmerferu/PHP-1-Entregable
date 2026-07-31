<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Carrito;
use App\Models\Producto;

class CarritoController {
    public function calcularTotal(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $carrito = $_SESSION['carrito'] ?? new Carrito();

        $accion = $_GET['accion'] ?? null;
        $productoId = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if ($productoId > 0) {
            $productos = [
                new Producto(1, "Remera Básica", "Algodón 100%", 25, 50, "Ropa", "👕"),
                new Producto(2, "Zapatillas", "Calzado running", 120, 20, "Ropa", "👟"),
                new Producto(3, "Auriculares", "Sonido envolvente", 85, 15, "Electrónica", "🎧"),
                new Producto(4, "Teclado", "Mecánico RGB", 45, 10, "Periféricos", "⌨️"),
                new Producto(5, "Mouse", "Óptico inalámbrico", 25, 15, "Periféricos", "🖱️"),
                new Producto(6, "Smartphone", "Pantalla 6.5", 350, 0, "Electrónica", "📱"),
            ];

            if ($accion === 'agregar') {
                foreach ($productos as $producto) {
                    if ($producto->getId() === $productoId) {
                        $carrito->agregarProducto($producto);
                        break;
                    }
                }
            } elseif ($accion === 'quitar') {
                $carrito->quitarProducto($productoId);
            }
        }

        $_SESSION['carrito'] = $carrito;

        $itemsCarrito = $carrito->getItems();
        $subtotal = $carrito->calcularSubtotal();
        $iva = $carrito->calcularIva($subtotal);
        $total = $subtotal + $iva;

        require_once __DIR__ . '/../Views/carrito.php';
    }
}
