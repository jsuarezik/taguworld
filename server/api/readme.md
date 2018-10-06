# Lumen 5.6

Clonar e instalar dependencias con composer

```sh
composer install 
```

## Correr servicio en localhost

Para correr el servicio del repositorio puedes usar el siguiente comando:

```sh
php -S localhost:8000 -t public
```

## Instalación y configuración

1. Revisar el archivo .env ahi estan los datos de la DB y keys de la app
3. Corre las migraciones y las semillas:

```sh
php artisan migrate --seed
```