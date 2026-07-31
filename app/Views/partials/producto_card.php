<?php

declare(strict_types=1);

if (!isset($producto) || !$producto instanceof \App\Models\Producto) {
    return;
}

$disponible = $producto->estaDisponible();
?>
<article class="card-producto">
    <div class="imagen"><?php echo $producto->getImagen(); ?></div>
    <h3><?php echo htmlspecialchars($producto->getNombre()); ?></h3>
    <p class="descripcion"><?php echo htmlspecialchars($producto->getDescripcion()); ?></p>
    <p class="precio">$<?php echo $producto->getPrecio(); ?></p>
    <?php if ($disponible): ?>
        <a class="btn" href="index.php?ruta=carrito&amp;accion=agregar&amp;id=<?php echo $producto->getId(); ?>">Agregar al carrito</a>
    <?php else: ?>
        <span class="agotado"><?php echo \App\Models\Producto::ESTADO_AGOTADO; ?></span>
    <?php endif; ?>
</article>
