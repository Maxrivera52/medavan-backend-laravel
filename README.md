## Medavan - Servicio
```
- Versión composer 2.2.6
- Versión laravel 8
```


## Generate models from database 
- php artisan krlove:generate:model  Business --table-name=business --namespace=App\Models --output-path=Models

## Create controller from model and resources
- php artisan make:controller StoreController --api --model=Store

## Create resource from controller
- php artisan make:resource StoreResource
  
## Create an event observer for a model when it is [updated, saved etc]
- php artisan make:observer OrderObserver --model=Order

## Create repository pattern

- php artisan make:provider RepositoryServiceProvider

- composer dump-autoload

## Add JWT 
- composer require tymon/jwt-auth

<code>
'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        .
        .
        .
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
        .
        .
        .
],
</code>
- php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

- php artisan jwt:secret


# Display public links for images (Storage)
- php artisan storage:link

# Implement notifications
- php artisan notification:table
- php artisan migrate
- php artisan migrate --path=database/migrations/2022_05_19_222022_create_notifications_table.php
- https://www.youtube.com/watch?v=FPRwQxtANzc



# Change connection from queue to database
- Edit file .env
```
QUEUE_CONNECTION=database
```
## Implement work queues with temporary database logging
```
php artisan queue:table
php artisan migrate --path=database/migrations/2022_06_08_214841_create_jobs_table.php
```
