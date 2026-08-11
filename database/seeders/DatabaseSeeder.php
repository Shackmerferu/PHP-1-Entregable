<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'demo@tienda.test'],
            ['name' => 'Usuario Demo', 'password' => 'password']
        );

        $categorias = [
            'Ropa' => 'Prendas de vestir para todas las edades.',
            'Electrónica' => 'Dispositivos y accesorios tecnológicos.',
            'Hogar' => 'Artículos para el hogar y la cocina.',
            'Deportes' => 'Equipamiento y accesorios deportivos.',
        ];

        foreach ($categorias as $nombre => $descripcion) {
            Categoria::firstOrCreate(['nombre' => $nombre], ['descripcion' => $descripcion]);
        }

        $productos = [
            ['Remera básica', 'Remera de algodón 100%, unisex.', 12999.99, 40, 'Ropa', Producto::ESTADO_DISPONIBLE],
            ['Jean clásico', 'Jean de corte recto, talle a elección.', 39999.99, 15, 'Ropa', Producto::ESTADO_DISPONIBLE],
            ['Auriculares inalámbricos', 'Auriculares Bluetooth con estuche de carga.', 54999.99, 8, 'Electrónica', Producto::ESTADO_DISPONIBLE],
            ['Smartphone gama media', 'Smartphone de 6.5", 128GB de almacenamiento.', 299999.99, 0, 'Electrónica', Producto::ESTADO_AGOTADO],
            ['Sartén antiadherente', 'Sartén de 24cm con mango ergonómico.', 18999.99, 25, 'Hogar', Producto::ESTADO_DISPONIBLE],
            ['Juego de sábanas', 'Juego de sábanas 2 plazas, 100% algodón.', 24999.99, 12, 'Hogar', Producto::ESTADO_DISPONIBLE],
            ['Pelota de fútbol', 'Pelota de fútbol n°5 para cancha de césped.', 15999.99, 30, 'Deportes', Producto::ESTADO_DISPONIBLE],
        ];

        foreach ($productos as [$nombre, $descripcion, $precio, $stock, $categoria, $estado]) {
            Producto::firstOrCreate(
                ['nombre' => $nombre],
                [
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'stock' => $stock,
                    'imagen' => null,
                    'estado' => $estado,
                    'categoria_id' => Categoria::where('nombre', $categoria)->first()->id,
                ]
            );
        }
    }
}
