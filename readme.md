#Installation

Create new Laravel Project
`laravel new <project_name>`

Update default string length in AppServiceProvider.php:

```
//Add following line in AppServiceProvider.php
use Illuminate\Support\Facades\Schema;
...
public function boot()
{
    ...
    //Add following line in boot() function of AppServiceProvider.php
    Schema::defaultStringLength(191);
}
```

Migrate database and enable auth
```
php artisan migrate
php artisan make:auth
```

Update User.php file with following lines to enable ACL:

```
// Use class HasRolesTrait
use PatilVishalVS\GenericCRUD\HasRolesTrait;
...
//Add trait to User model as follow
...
use Notifiable, HasRolesTrait;
```

Register new middleware in Kernel.php
```
protected $routeMiddleware = [
  ...
    'generic_crud' => \PatilVishalVS\GenericCRUD\GenericAuthMiddleware::class,
];
```

Seed and Publish vendor resources and assets then serve
```
php artisan db:seed --class="PatilVishalVS\GenericCRUD\seeds\DatabaseSeeder"
php artisan vendor:publish --tag=public
php artisan vendor:publish --tag=resources
php artisan serve
```
