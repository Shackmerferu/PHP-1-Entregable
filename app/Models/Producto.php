<?php

declare(strict_types=1);

namespace App\Models;

class Producto {
    public const ESTADO_DISPONIBLE = 'Disponible';
    public const ESTADO_AGOTADO = 'Agotado';

    private int $id;
    private string $nombre;
    private string $descripcion;
    private int $precio;
    private int $stock;
    private string $categoria;
    private string $imagen;

    public function __construct(
        int $id,
        string $nombre,
        string $descripcion,
        int $precio,
        int $stock,
        string $categoria,
        string $imagen
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->categoria = $categoria;
        $this->imagen = $imagen;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getPrecio(): int {
        return $this->precio;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function getCategoria(): string {
        return $this->categoria;
    }

    public function getImagen(): string {
        return $this->imagen;
    }

    public function estaDisponible(): bool {
        return $this->stock > 0;
    }
}
