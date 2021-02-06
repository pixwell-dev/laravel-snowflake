<?php

namespace PixwellDev\LaravelSnowflake\Traits;

use PixwellDev\LaravelSnowflake\LaravelSnowflakeFacade;

trait HasSnowflakePrimary
{
    public static function bootHasSnowflakePrimary()
    {
        static::saving(function ($model) {
            if (is_null($model->getKey())) {
                $model->setIncrementing(false);

                $model->setAttribute($model->getKeyName(), LaravelSnowflakeFacade::id());
            }
        });
    }
}
