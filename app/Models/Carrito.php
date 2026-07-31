<?php

declare(strict_types=1);

namespace App\Models;

class Carrito {
    public const IVA = 0.21;

    private array $items = [];

    public function agregarProducto(Producto $producto, int $cantidad = 1): void {
        foreach ($this->items as $i => $item) {
            if ($item['producto']->getId() === $producto->getId()) {
                $this->items[$i]['cantidad'] += $cantidad;
                return;
            }
        }
        $this->items[] = ['producto' => $producto, 'cantidad' => $cantidad];
    }

    public function quitarProducto(int $productoId): void {
        foreach ($this->items as $i => $item) {
            if ($item['producto']->getId() === $productoId) {
                $this->items[$i]['cantidad']--;
                if ($this->items[$i]['cantidad'] <= 0) {
                    array_splice($this->items, $i, 1);
                }
                return;
            }
        }
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getCantidadItems(): int {
        return count($this->items);
    }

    public function calcularSubtotal(): int {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $item['producto']->getPrecio() * $item['cantidad'];
        }
        return $subtotal;
    }

    public function calcularIva(int $subtotal): int {
        return (int) round($subtotal * self::IVA);
    }
}
