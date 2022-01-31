
## Install Laravel
- run composer install

##Install JWT
-composer require tymon/jwt-auth
'providers' => [

    ...

    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
]

run this comman  - php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

run - php artisan jwt:secret

- add your Database and config env file
- run php migrate:fresh --seed
- run php artisan serve

#Postman uses collection
-find the file name collection.json and import your postman and check every route.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
