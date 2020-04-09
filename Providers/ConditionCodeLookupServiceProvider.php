<?php

/*
 * This file is part of CarePlan Manager by CircleLink Health.
 */

namespace subzero10\ConditionCodeLookup\Providers;

use Illuminate\Support\ServiceProvider;
use subzero10\ConditionCodeLookup\ConditionCodeLookup;
use subzero10\ConditionCodeLookup\Console\Commands\LookupCondition;
use subzero10\ConditionCodeLookup\Services\ConditionCodeLookupService;

class ConditionCodeLookupServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        ConditionCodeLookup::class => ConditionCodeLookupService::class,
    ];

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
        $this->commands([
            LookupCondition::class
        ]);
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
