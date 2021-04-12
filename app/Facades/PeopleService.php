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
