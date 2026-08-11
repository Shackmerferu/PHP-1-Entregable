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
