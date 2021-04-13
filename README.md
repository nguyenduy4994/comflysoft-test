# Requirement

Check out [Laravel Requirements & Installations](https://laravel.com/docs/8.x#installation).

Must meet minimum requirement:
- PHP >= 7.3
- Composer
- NPM
- MySQL 8+

# System design



# Installation
Clone from this repository
```bash
git clone git@github.com:nguyenduy4994/comflysoft-test.git
```

Install by following command
```bash
cd comflysoft-test
composer install
yarn install
```

Copy new environment file
```bash
cp .env.example .env
```

Generate new key
```bash
php artisan key:generate
```

Migration & seed
```bash
# For new install
php artisan migrate --seed

# If you want to drop all table and migrate new
php artisan migrate:refresh --seed
```

Generate IDE helper file
```bash
php artisan clear-compiled
php artisan ide-helper:generate
```

Run npm to build style
```
yarn dev
// or watching change files
yarn watch
```

Run test
```bash
php artisan test
```

# Coding style & Fixing

Applied from the style set that Laravel is using from Styleci. Simply use command to fix basic style
```bash
composer fix-style
```

You can use php-cs-fixer implement to your IDE to automatic fix style when saving, commit.

Follow [PSR standards](http://www.php-fig.org/psr/psr-2/).
 
# Package usage
- **[barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)** use for debuging.
- **[barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)** use for generating file which helps IDE auto complete.
- **[matt-allan/laravel-code-style](https://github.com/matt-allan/laravel-code-style)**  The tools checks the input PHP source code and reports any deviations from the coding convention.


# Structure & Guide
## Model

### Usage
All models are in `App\Models`

Model example
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
```

## Constant
All constant are defined in namespace `App\Constants` in folder `app\Constants`

Example:
```php
<?php

namespace App\Constants;

class Error
{
    const PEOPLE_STORE_FAIL = 1;
    const POINT_STORE_FAIL = 2;
}

```

## Service & Facade

### Introduction
I apply Facade in services to help more convenient in writing code. Please check the [Facades document](https://laravel.com/docs/8.x/facades)

All service in namespace `App\Services` in folder `app/Services`. All service's facades in namespace `App\Facades`.

### How to create services

Step 1: Define a Service class in folder `app/Services`

```php
<?php

namespace App\Services;

class PeopleService extends Service
{
}

```

Step 2: Define a Facade class in folder `app/Facades` with 

```php
<?php

namespace App\Facades;

use App\Services\PeopleService as ServicesPeopleService;
use Illuminate\Support\Facades\Facade;

class PeopleService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ServicesPeopleService::class;
    }
}
```

### How to use service 

```php
<?php

namespace App\Http\Controllers;

use App\Facades\PointService;

class DashboardController extends Controller
{
    public function index()
    {
        // ...
        $points = PointService::getWithPaginate(),

        // ...
    }
}

```

## Routing
All route in folder `routes`:
- `web.php`: route for all

## Form request
All form request are defined in `app\Http\Requests` with name `Store` or `Update` depending on what type of the request.

## Logging & Exception

### Logging

All exceptions are logged as Laravel document. 

### Exception

I implement custom Exception in folder ```App\Exceptions```. When store fail, throw StoreFailException.

## Logging

Follow guide from: https://laravel.com/docs/8.x/logging

## Best practice

Please check https://github.com/alexeymezenin/laravel-best-practices
