<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compras</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; background: #f7f7f7; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { text-align: center; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem; }
        .card-producto { background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 1rem; display: flex; flex-direction: column; gap: 0.4rem; text-align: center; }
        .imagen { font-size: 4rem; }
        .card-producto h3 { margin: 0; }
        .descripcion { color: #666; margin: 0; }
        .precio { font-size: 1.3rem; font-weight: bold; margin: 0; }
        .cantidad { display: flex; align-items: center; justify-content: center; gap: 0.6rem; }
        .btn { display: inline-block; background: #0369a1; color: #fff; text-decoration: none; padding: 0.4rem 0.8rem; border-radius: 6px; }
        .btn.gris { background: #666; }
        .totales { background: #fff; padding: 1rem 1.5rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 400px; margin: 1.5rem auto 0; }
        .totales p { margin: 0.3rem 0; }
        .vacio { text-align: center; }
        .enlace { display: inline-block; margin-top: 1rem; text-decoration: none; color: #0369a1; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Carrito de compras</h1>

        <?php if (empty($itemsCarrito)): ?>
            <p class="vacio">El carrito está vacío.</p>
            <p class="vacio"><a class="btn" href="index.php?ruta=tienda">Ver productos</a></p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($itemsCarrito as $item): ?>
                    <?php $producto = $item['producto']; ?>
                    <?php $cantidad = $item['cantidad']; ?>
                    <article class="card-producto">
                        <div class="imagen"><?php echo $producto->getImagen(); ?></div>
                        <h3><?php echo htmlspecialchars($producto->getNombre()); ?></h3>
                        <p class="descripcion"><?php echo htmlspecialchars($producto->getDescripcion()); ?></p>
                        <p class="precio">$<?php echo $producto->getPrecio(); ?></p>
                        <div class="cantidad">
                            <a class="btn gris" href="index.php?ruta=carrito&amp;accion=quitar&amp;id=<?php echo $producto->getId(); ?>">-</a>
                            <span><strong><?php echo $cantidad; ?></strong> x $<?php echo $producto->getPrecio(); ?></span>
                            <a class="btn" href="index.php?ruta=carrito&amp;accion=agregar&amp;id=<?php echo $producto->getId(); ?>">+</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="totales">
                <p><strong>Subtotal:</strong> $<?php echo number_format((float) $subtotal, 2, ',', '.'); ?></p>
                <p><strong>IVA (<?php echo (int) (\App\Models\Carrito::IVA * 100); ?>%):</strong> $<?php echo number_format((float) $iva, 2, ',', '.'); ?></p>
                <p><strong>Total:</strong> $<?php echo number_format((float) $total, 2, ',', '.'); ?></p>
                <p><a class="enlace" href="index.php?ruta=tienda">Seguir comprando</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
