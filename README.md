# Tienda de Negocios 🎍

Entregable Práctico — PHP & Laravel | La Pampa

**Entrega 1:** Fundamentos de PHP y diseño de la aplicación (PHP puro + MVC manual, sin framework).

## Requisitos del entorno

- **PHP** 8.2 o superior
- **Composer** 2.x
- Un servidor web local: `php -S` o **XAMPP/MAMP** (Apache)

## Instalación

1. Clonar o copiar el proyecto en el directorio del servidor web
   (en XAMPP: `C:\xampp\htdocs\tienda-clase-01`).

2. Instalar las dependencias y generar el autoloader de Composer:

   ```bash
   composer install
   ```

   > Si el archivo `composer.json` cambió, regenerar el autoloader con:
   > ```bash
   > composer dump-autoload
   > ```

3. Iniciar el servidor de desarrollo (alternativa a XAMPP):

   ```bash
   php -S localhost:8000 -t public
   ```

4. Abrir en el navegador: <http://localhost:8000>

## Uso

El front controller (`public/index.php`) recibe la acción a través del parámetro `ruta`:

| Ruta                    | Descripción                                   |
|-------------------------|-----------------------------------------------|
| `?ruta=tienda`          | Portada con catálogo en grilla, filtro por categoría y carrito |
| `?ruta=productos`       | Catálogo en grilla (imagen, título, desc., precio) |
| `?ruta=categorias`      | Filtro de productos por categoría (integrado también en la tienda) |
| `?ruta=carrito`         | Carrito con agregar/quitar cantidad (se elimina al llegar a 0) |

El carrito se guarda en la sesión (`$_SESSION`) para conservar los productos mientras se navega.
Acciones del carrito: `?ruta=carrito&accion=agregar&id=1` y `?ruta=carrito&accion=quitar&id=1`.

La ruta predeterminada es la **tienda** (portada). Ejemplo: <http://localhost:8000/index.php>

## Arquitectura Modelo-Vista-Controlador (MVC)

El proyecto organiza el código siguiendo el patrón MVC de forma manual.

```
public/                       Punto de entrada (Front Controller)
└── index.php                 Recibe ?ruta= y delega al controlador correspondiente

app/
├── Controllers/              Reciben la acción, coordinan modelo y vista
│   ├── ProductoController.php
│   ├── CarritoController.php
│   ├── CategoriaController.php
│   └── TiendaController.php
├── Models/                   Dominio de la tienda (POO, sin base de datos)
│   ├── Producto.php
│   ├── Categoria.php
│   ├── Usuario.php
│   └── Carrito.php
└── Views/                    HTML que muestran los datos que envía el controlador
    ├── listar_productos.php
    ├── vista_categoria.php
    ├── carrito.php
    ├── layout.php
    └── partials/
        └── producto_card.php  Tarjeta de producto reutilizable (grilla)
```

### Flujo de comunicación

```
        ?ruta=tienda
   (1) ───────────────► public/index.php
                              │  instancia
                              ▼
                        ProductoController::listar()
                         │           │
                   (2) crea      (3) prepara datos
                         ▼           ▼
                  Models/Producto   requiere la vista
                                         │
                                   (4) muestra HTML
                                         ▼
                                 app/Views/listar_productos.php
```

1. **Navegador** → `public/index.php` con el parámetro `ruta`.
2. El **controlador** crea/consulta los **modelos** (datos en memoria, arrays o archivos).
3. El **controlador** le pasa los datos a la **vista**.
4. La **vista** genera el **HTML** final que se devuelve al navegador.

### Modelo de dominio

- **Producto**: id, nombre, descripción, precio, stock, categoría e imagen. Constantes `ESTADO_DISPONIBLE` / `ESTADO_AGOTADO` y método `estaDisponible()`.
- **Categoria**: id, nombre, y relación *una categoría tiene muchos productos* (`agregarProducto()` / `obtenerProductos()`).
- **Usuario**: id, nombre, email, rol (`admin` / `cliente`), con `esAdmin()`.
- **Carrito**: items con cantidad por producto. `agregarProducto($producto, $cantidad)` acumula, `quitarProducto($id)` resta y remueve el item si llega a 0, `getItems()`, `calcularSubtotal()` y `calcularIva()`. Constante `IVA` (21%).

Los productos se definen como arrays de objetos `Producto` dentro de cada controlador (datos en memoria, sin base de datos ni repositorio externo).

## Buenas prácticas aplicadas

- Nomenclatura clara y consistente (camelCase para métodos y variables, PascalCase para clases).
- Tipado estricto (`declare(strict_types=1)`) y type hints en propiedades, parámetros y retornos.
- Constantes de clase para valores fijos del dominio (roles, estados).
- Namespaces `App\` y autoloading PSR-4 vía Composer.
- Vistas protegidas contra XSS con `htmlspecialchars()`.
- El carrito accede a los datos de Producto mediante getters (encapsulamiento).

## Trabajo con Git

El proyecto incluye un `.gitignore` que excluye `vendor/` y archivos del editor.

```bash
git init
git add .
git commit -m "Entrega 1: fundamentos de PHP y arquitectura MVC"
```

Se recomienda un commit por sesión de trabajo con mensajes descriptivos.
