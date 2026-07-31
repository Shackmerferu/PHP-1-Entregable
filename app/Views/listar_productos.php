<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos</title>
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
        .btn { display: inline-block; background: #0369a1; color: #fff; text-decoration: none; padding: 0.5rem 0.8rem; border-radius: 6px; }
        .agotado { color: #b91c1c; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Catálogo de productos</h1>
        <div class="grid">
            <?php foreach ($productos as $producto): ?>
                <?php include __DIR__ . '/partials/producto_card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
