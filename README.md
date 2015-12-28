# laravel-api-autodoc
An automatic api documentation generator for Laravel applications.

## Quick Start


### Installation

#### Install Through Composer
You can either add the package directly by firing this command

```
$ composer require rabblerouser/api-autodoc:~0.0.5
```

-- or --

Add in the `require` key of `composer.json` file manually

```
"rabblerouser/api-autodoc": "~0.0.5"
```

And Run the Composer update command

```
$ composer update
```

#### Add Service Providers (Lumen)

Add the following service providers to your `bootstrap/app.php` file.

```php
$app->register(RabbleRouser\ApiAutoDoc\Providers\DocumentationServiceProvider::class);
$app->register('Irazasyed\Larasupport\Providers\ArtisanServiceProvider');
```

#### Add Service Providers (Laravel)

Add the following service providers to your `config/app.php` file.

```php
'providers' => [
    // Other Service Providers
        RabbleRouser\ApiAutoDoc\Providers\DocumentationServiceProvider::class,
        'Irazasyed\Larasupport\Providers\ArtisanServiceProvider'
],
```

#### Override Doc View Templates

If you want to override the default view templates, run the artisan `publish` command.

```
$ php artisan vendor:publish
```

This will create a vendor/api-autodoc/views/ directory in the `resources` directory of your Lumen/Laravel installation.
Api AutoDoc will load those templates instead of its defaults.

## Usage

In your application's `routes.php` file, add a `docCategory` parameter to the route array.

#### Example

```php
    $app->get('some_resource', [
        'uses' => 'App\Http\Controllers\SomeResourceController@index',
        'docCategory' => 'Some Resource'
    ]);
```

You can see your autogenerated API documentation by going to the `/docs` page of your site.

#### Example

```
    http://api.mywebservice.com/docs
```

## License

[MIT](LICENSE) © [Rabble + Rouser](http://rabbleandrouser.com)
