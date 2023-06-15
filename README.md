install:

```php
composer require icekristal/laravel-drafts
```

migration:

```php
php artisan vendor:publish --provider="Icekristal\LaravelDraft\DraftServiceProvider" --tag="migrations"
```

config:

```php
php artisan vendor:publish --provider="Icekristal\LaravelDraft\DraftServiceProvider" --tag="config"
```

## Usage

set route:

```php
        Route::group([
            'prefix' => 'drafts',
            'as' => 'drafts.',
        ], function () {
            Route::get('/list', [DraftsController::class, 'index']);
            Route::post('/store', [DraftsController::class, 'store']);
            Route::post('/{draft}/update', [DraftsController::class, 'update']);
            Route::delete('/{draft}/delete', [DraftsController::class, 'delete']);
        });
```

set Trait owner draft:

```php
use DraftTrait;
```    
