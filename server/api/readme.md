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

## Rutas

GET /api/routes Lista toda las rutas
GET /api/routes/{id} Detalle de una ruta
POST /api/routes Crea una ruta
POST /api/routes/{id}/driver Le asigna un driver a la ruta 

GET /api/drivers Lista toda las conductores
GET /api/drivers/{id} Detalle de una conductor
POST /api/drivers Crea una conductor