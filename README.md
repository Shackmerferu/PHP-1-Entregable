# Tienda de Negocios 🎍

Proyecto integrador de la materia **PHP & Laravel | La Pampa**.
Tienda en línea construida de forma incremental en entregas. Esta es la **Entrega 2**: migración del diseño de dominio y MVC de la Entrega 1 hacia el framework **Laravel**, con Eloquent ORM, migraciones, validación con Form Requests y vistas Blade navegables.

## Instalación

```bash
# 1. Crear el proyecto con Composer
composer create-project laravel/laravel tienda-online

# 2. Configurar la base de datos en .env (MySQL)
# DB_CONNECTION=mysql
# DB_DATABASE=tienda_online

# 3. Ejecutar las migraciones para crear el esquema
php artisan migrate

# 4. Levantar el servidor de desarrollo
php artisan serve
```

## Estructura del proyecto (comparación con la Entrega 1)

| Entrega 1 (PHP puro)          | Entrega 2 (Laravel)             | Función |
|-------------------------------|---------------------------------|---------|
| `public/index.php` (router a mano) | `public/index.php` (front controller) | punto de entrada de toda la app |
| `app/Controllers/`            | `app/Http/Controllers/`         | reciben la request y coordinan el flujo |
| `app/Models/` (clases con getters) | `app/Models/` (extienden `Model`) | representan tablas de la BD |
| `app/Views/` (`require_once`) | `resources/views/*.blade.php`   | plantillas con el motor Blade |
| datos en arrays + sesión      | base de datos MySQL (Eloquent)  | persistencia real |
| `-`                           | `database/migrations/`          | versionado de la estructura de la BD |
| `-`                           | `.env`, `config/`               | configuración centralizada |
| `-`                           | `routes/web.php`, `routes/api.php` | definición de rutas declarativa |

## ¿Por qué Laravel y no PHP puro o Lumen?

- **PHP puro:** hay que escribir a mano rutas, conexión a BD, validación y seguridad (CSRF, XSS, SQL injection). Sirve para aprender MVC, pero no escala.
- **Lumen:** microframework del mismo equipo, muy liviano y rápido, **solo para APIs REST**. No incluye Blade completo ni autenticación; falta agregar todo manualmente.
- **Laravel:** framework completo: enrutamiento, Eloquent ORM, Blade, migraciones, validación y middleware listos para usar. Es la opción correcta para una tienda con vistas web navegables y base de datos.

## Validación con Form Requests

La entrada al crear y editar productos se valida con **Form Requests**, que centralizan las reglas fuera del controlador:

- `app/Http/Requests/StoreProductRequest.php` — se inyecta en `ProductoController@store`.
- `app/Http/Requests/UpdateProductRequest.php` — se inyecta en `ProductoController@update`.

Reglas aplicadas (ambas clases):

| Campo          | Reglas                                                     |
|----------------|------------------------------------------------------------|
| `nombre`       | `required`, `string`, `max:120`                            |
| `descripcion`  | `nullable`, `string`, `max:500`                            |
| `precio`       | `required`, `numeric`, `min:0`                             |
| `stock`        | `required`, `integer`, `min:0`, regla personalizada        |
| `imagen`       | `nullable`, `string`, `max:255`                            |
| `estado`       | `required`, `in:Disponible,Agotado`                        |
| `categoria_id` | `required`, `exists:categorias,id`                         |

**Regla personalizada (`reglaStockConEstado`):** un `Closure` que valida la coherencia entre `estado` y `stock`. Si el producto figura como **Disponible**, su stock debe ser mayor a `0`; de lo contrario la validación falla con el mensaje *"Un producto Disponible debe tener stock mayor a 0."*

## Flujo de información en Laravel

Cuando el navegador pide `GET /productos`, la petición recorre la cadena **ruta → controlador → modelo → vista → respuesta**:

1. **Punto de entrada** — `public/index.php` arranca la aplicación y crea el kernel HTTP (`bootstrap/app.php`).
2. **Middleware** — la request atraviesa la pila del grupo `web` (sesión, cookies, CSRF, etc.) antes de llegar a la ruta.
3. **Ruta** — `routes/web.php` asocia `GET /productos` con `ProductoController@index`, bajo el nombre `productos.index`:
   ```php
   Route::resource('productos', ProductoController::class);
   ```
4. **Controlador** — `ProductoController::index()` consulta datos con Eloquent y pasa el resultado a la vista:
   ```php
   public function index()
   {
       $productos = Producto::with('categoria')->paginate(9);
       return view('productos.index', compact('productos'));
   }
   ```
5. **Modelo** — `Producto` (Eloquent) ejecuta la consulta SQL sobre la tabla `productos` de MySQL y carga la relación `categoria` para evitar consultas innecesarias (N+1).
6. **Vista** — `resources/views/productos/index.blade.php` se compila a PHP y genera el HTML con los datos recibidos.
7. **Respuesta** — Laravel envía la respuesta HTTP con el HTML renderizado y el navegador la muestra.

Para un `POST` (por ejemplo crear un producto) el flujo incluye además el **Form Request** (`StoreProductRequest`), que valida los datos antes de que el controlador persista con `Producto::create()`; si la validación falla, redirige de vuelta con los errores.
