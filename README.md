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
Iniciar apache por XAMPP
```
Una vez iniciado
Después entrá a `http://localhost/ruta_carpeta/index.php`.

## Páginas

- `index.php` → tienda (portada). Muestra los productos en grilla, con filtro por categoría y botón para agregar al carrito.
- `index.php?ruta=carrito` → carrito. Con botones + y - para cambiar la cantidad; si llegás a 0, el producto se borra del carrito.

El carrito se guarda en la sesión del navegador.

## Estructura y diseño MVC

```
public/            index.php (punto de entrada)
app/
  Controllers/     Controladores: TiendaController, CarritoController
  Models/          Producto, Categoria, Usuario, Carrito
  Views/           HTML: tienda.php, carrito.php, partials/
```

Cada capa hace una cosa:

- **Modelo** (`app/Models`): las clases del dominio (Producto, Categoria, Usuario, Carrito). Los datos se guardan en memoria, en arrays de objetos, sin base de datos.
- **Vista** (`app/Views`): el HTML. Solo recibe datos ya armados por el controlador y los muestra. No hace lógica de negocio.
- **Controlador** (`app/Controllers`): recibe la ruta desde `index.php`, crea los objetos del modelo y les pasa los datos a las vistas.

### Cómo fluye una petición

1. El navegador pide `index.php` (por defecto, sin parámetros, carga la tienda).
2. `public/index.php` lee `?ruta=` y elige el controlador:
   - sin parámetro → `TiendaController` (portada con productos y filtro)
   - `?ruta=carrito` → `CarritoController` (carrito con + y -)
3. El controlador arma los `Producto` (arrays en memoria) o el `Carrito` (guardado en la sesión), hace el cálculo (subtotal, IVA) y pide la vista.
4. La vista genera el HTML final que ve el usuario.

Ejemplo: `index.php` → `TiendaController` → crea `Producto` y `Carrito` → `tienda.php` muestra la grilla.

## Git

```bash
git init
git add .
git commit -m "Entrega 1"
```
