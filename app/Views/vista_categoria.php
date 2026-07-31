<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar por categoría</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; background: #f7f7f7; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { text-align: center; }
        .filtros { display: flex; gap: 0.5rem; justify-content: center; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .filtro { text-decoration: none; padding: 0.4rem 0.9rem; border-radius: 999px; background: #fff; color: #0369a1; border: 1px solid #0369a1; }
        .filtro.activo { background: #0369a1; color: #fff; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem; }
        .card-producto { background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 1rem; display: flex; flex-direction: column; gap: 0.4rem; text-align: center; }
        .imagen { font-size: 4rem; }
        .card-producto h3 { margin: 0; }
        .descripcion { color: #666; margin: 0; }
        .precio { font-size: 1.3rem; font-weight: bold; margin: 0; }
        .btn { display: inline-block; background: #0369a1; color: #fff; text-decoration: none; padding: 0.5rem 0.8rem; border-radius: 6px; }
        .agotado { color: #b91c1c; font-weight: bold; }
        .sin-resultados { text-align: center; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Productos por categoría</h1>

        <nav class="filtros">
            <a class="filtro <?php echo $categoriaSeleccionada === 'Todas' ? 'activo' : ''; ?>"
               href="index.php?ruta=categorias">Todas</a>
            <?php foreach ($categorias as $categoria): ?>
                <a class="filtro <?php echo $categoriaSeleccionada === $categoria ? 'activo' : ''; ?>"
                   href="index.php?ruta=categorias&amp;categoria=<?php echo urlencode($categoria); ?>">
                    <?php echo htmlspecialchars($categoria); ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <?php if (empty($productos)): ?>
            <p class="sin-resultados">No hay productos en esta categoría.</p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($productos as $producto): ?>
                    <?php include __DIR__ . '/partials/producto_card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
