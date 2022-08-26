# Structure, traits and helpers for  REST API projects fast development

## Installation

-Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composerd require kraify/fastdev  
```

## Usage
- Add the extension package's service provider `Kraify\Fastdev\FastDevServiceProvider` to the `providers` array in `config/app.php`.

```php
'providers' => [
    /*
     * Package Service Providers...
     */
    Kraify\Fastdev\FastDevServiceProvider::class,
 ]
```

- Next you need to execute artisan comand
```bash
    php artisan kraify:install
```

