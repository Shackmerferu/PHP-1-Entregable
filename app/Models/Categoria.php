<?php

declare(strict_types=1);

namespace App\Models;

class Categoria {
    private int $id;
    private string $nombre;
    private array $productos = [];

    public function __construct(int $id, string $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function agregarProducto(Producto $producto): void {
        $this->productos[] = $producto;
    }

    public function obtenerProductos(): array {
        return $this->productos;
    }
}
