# Tienda de Negocios

Proyecto de PHP + Laravel (Entrega 1). Tienda simple con PHP puro y MVC hecho a mano, sin framework y sin base de datos. Los productos son arrays en memoria.

## Requisitos

- PHP 8.2 o superior
- Composer

## Instalación

1. Copiar el proyecto en `htdocs` (XAMPP) o en la carpeta que uses.
2. `composer install` (genera el autoloader).
3. Si cambiás el `composer.json`, correr `composer dump-autoload`.

## Correr

```bash
php -S localhost:8000 -t public
```

Después entrá a `http://localhost:8000`.

## Páginas

- `index.php` → tienda (portada). Muestra los productos en grilla, con filtro por categoría y botón para agregar al carrito.
- `index.php?ruta=carrito` → carrito. Con botones + y - para cambiar la cantidad; si llegás a 0, el producto se borra del carrito.

El carrito se guarda en la sesión del navegador.

## Estructura

```
public/            index.php (punto de entrada)
app/
  Controllers/     reciben la ruta y arman los datos
  Models/          Producto, Categoria, Usuario, Carrito
  Views/           HTML que muestra cada página
```

Flujo: el navegador pega a `public/index.php`, este elige el controlador según `ruta`, el controlador arma los objetos y le pasa los datos a la vista, y la vista genera el HTML.

## Git

```bash
git init
git add .
git commit -m "Entrega 1"
```
