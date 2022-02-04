
## Install Laravel
- run composer install

## Online Vertion
    - `www.api.tipu.me/api/{{endpoint}}`
    
    example: 
    - `www.api.tipu.me/api/auth/login`
    
    credential : 
    mail : ``` john@example.com ``` Admin user
    password : ``` password ```

##Install JWT
- composer require tymon/jwt-auth

- run php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
- run  php artisan jwt:secret

- add your Database and config env file
- run php migrate:fresh --seed
- run php artisan serve

#Postman uses collection
-find the folder name `Postman Collection` and import your postman and check every route.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
