<?php

/*
 * This file is part of CarePlan Manager by CircleLink Health.
 */

namespace subzero10\Core\Providers;

use Illuminate\Support\ServiceProvider;

class ConditionCodeLookupServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register config.
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('condition-code-lookup.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php',
            'core'
        );
    }
}
