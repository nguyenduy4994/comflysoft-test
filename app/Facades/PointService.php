<?php

namespace App\Facades;

use App\Services\PointService as ServicesPointService;
use Illuminate\Support\Facades\Facade;

class PointService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ServicesPointService::class;
    }
}
