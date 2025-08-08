# Shops App

Aplicación de gestión de productos, categorías y marcas desarrollada en Laravel + Tailwind CSS.

## Características

-   CRUD de productos, categorías y marcas
-   Relación de productos con categorías y marcas
-   Vistas responsivas y modernas con Tailwind CSS
-   Seeders y factories para poblar la base de datos con datos realistas
-   Migraciones y control de versiones de base de datos

## Requisitos

-   PHP >= 8.1
-   Composer
-   Node.js y npm
-   Laravel 10+
-   Base de datos MySQL o SQLite

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tu-usuario/shops-app.git
    cd shops-app
    ```
2. Instala dependencias PHP:
    ```bash
    composer install
    ```
3. Instala dependencias JS:
    ```bash
    npm install
    ```
4. Copia el archivo de entorno y configura tus variables:
    ```bash
    cp .env.example .env
    # Edita .env según tu entorno
    ```
5. Genera la clave de la app:
    ```bash
    php artisan key:generate
    ```
6. Ejecuta migraciones y seeders:
    ```bash
    php artisan migrate:fresh --seed
    ```
7. Compila los assets:
    ```bash
    npm run dev
    ```
8. Inicia el servidor:
    ```bash
    php artisan serve
    ```

## Uso

-   Accede a la app en [http://localhost:8000](http://localhost:8000)
-   Navega por los productos, categorías y marcas
-   Prueba el CRUD y la visualización en grilla

## Estructura principal

-   `app/Models` — Modelos Eloquent
-   `database/migrations` — Migraciones de base de datos
-   `database/seeders` — Seeders para poblar datos
-   `database/factories` — Factories para datos de prueba
-   `resources/views` — Vistas Blade
-   `routes/web.php` — Rutas web

## Créditos

-   Laravel
-   Tailwind CSS
-   Faker

---

¡Contribuciones y sugerencias son bienvenidas!
