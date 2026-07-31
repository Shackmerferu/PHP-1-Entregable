<?php

declare(strict_types=1);

namespace App\Models;

class Usuario {
    public const ROL_ADMIN = 'admin';
    public const ROL_CLIENTE = 'cliente';

    private int $id;
    private string $nombre;
    private string $email;
    private string $rol;

    public function __construct(int $id, string $nombre, string $email, string $rol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->rol = $rol;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getRol(): string {
        return $this->rol;
    }

    public function esAdmin(): bool {
        return $this->rol === self::ROL_ADMIN;
    }
}
