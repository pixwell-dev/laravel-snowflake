<?php

namespace PixwellDev\LaravelSnowflake;

use Godruoyi\Snowflake\LaravelSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSnowflakeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-snowflake')
            ->hasConfigFile('snowflake');
    }

    public function registeringPackage()
    {
        $this->app->singleton('snowflake', function () {
            $config = config('snowflake');

            $snowflake = (new Snowflake($config['datacenter_id'], $config['worker_id']))
                ->setStartTimeStamp(strtotime($config['epoch']) * 1000);

            if ($config['resolver'] === 'laravel-redis-cache') {
                $snowflake = $snowflake
                    ->setSequenceResolver(new LaravelSequenceResolver($this->app->get('cache')->store()));
            }

            return $snowflake;
        });
    }
}
