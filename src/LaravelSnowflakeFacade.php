<?php

namespace PixwellDev\LaravelSnowflake;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PixwellDev\LaravelSnowflake\LaravelSnowflake
 */
class LaravelSnowflakeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'snowflake';
    }
}
