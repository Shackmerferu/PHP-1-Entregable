<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ProductoController;
use App\Controllers\CarritoController;
use App\Controllers\CategoriaController;
use App\Controllers\TiendaController;

$ruta = $_GET['ruta'] ?? 'tienda';

switch ($ruta) {
    case 'carrito':
        (new CarritoController())->calcularTotal();
        break;
    case 'tienda':
        (new TiendaController())->mostrarTienda();
        break;

    default:
        http_response_code(404);
        echo '404 - Recurso no encontrado.';
        exit;
}
