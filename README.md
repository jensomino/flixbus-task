<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Getting Started
For starting simply use this command
~~~ 
docker-compose up -d
~~~ 
For stopping the containers use this command
~~~ 
docker-compose down
~~~
Then Run migration inside php container
~~~ 
php artisan migrate
~~~
## Usage
All task example has been defined as a test case, you can run it with bellow command
~~~ 
php artisan test
~~~ 
You can use postman for api guide in this directory
~~~ 
./public/flixbus.postman_collection.json
~~~
Panel URL
~~~ 
http://localhost/panel
~~~

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
