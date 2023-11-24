<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Execution
First, we need to create the .env file, for this we can create the file and copy + paste the content
of the .env.example file.

Then, to run the project and create migrations, fake data, we need to run the following commands:
```
composer install
         &
php artisan migrate --seed
```

After having this executed we should be able to do requests to the api, in the root folder of the project there's a file called ``Insomnia_2023-11-24.json`` that contains the collection of the endpoints created, i've used Insomnia for the ep testing, but i think this file should be able to be opened on postman as well

### Developer Notes:
Here's a list of the progress based on the requirements and extras features requested on the test, the green ones are the completed and the red ones are the not covered (Due to time not to experience):

Requisitos:
- Utilizar Laravel 9 o 10, BBDD MySQL 🟩
- JWT para el token 🟩
- Crear test unitarios 🟩
- Crear factories de todos los modelos 🟩
- Seeder para crear usuario con los 2 roles 🟩
- Buenas prácticas de programación en base al estándar de la comunidad de Laravel 🟩 (Bajo PSR2 y demas)

Extra
- Utilizar caché para obtener los candidatos 🟥
- Implementar patrón repository 🟩
- Form Request 🟩
- Manejo de excepción 🟩
- Eloquent Api Resource 🟩
- Cobertura 100% de unit testing 🟥
- Utilizar Sonarqube para el analisis del código estatico 🟥
