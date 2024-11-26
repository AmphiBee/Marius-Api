<?php

namespace AmphiBee\MariusApi\Providers;

use AmphiBee\MariusApi\Services\CampusService;
use AmphiBee\MariusApi\Services\CandidatureService;
use AmphiBee\MariusApi\Services\FormationService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Service Provider for Marius API integration.
 * Handles service registration and configuration publishing.
 */
class MariusServiceProvider extends ServiceProvider
{
    /**
     * Register API services and merge configuration.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/marius.php', 'marius');

        // Register services as singletons
        $this->app->singleton(CampusService::class, fn (Application $app): \AmphiBee\MariusApi\Services\CampusService => new CampusService($app['config']['marius']));

        $this->app->singleton(FormationService::class, fn (Application $app): \AmphiBee\MariusApi\Services\FormationService => new FormationService($app['config']['marius']));

        $this->app->singleton(CandidatureService::class, fn (Application $app): \AmphiBee\MariusApi\Services\CandidatureService => new CandidatureService($app['config']['marius']));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<class-string>
     */
    public function provides(): array
    {
        return [
            CampusService::class,
            FormationService::class,
            CandidatureService::class,
        ];
    }

    /**
     * Bootstrap the package services.
     * Publishes configuration file to the application.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/marius.php' => config_path('marius.php'),
        ], 'marius-config');
    }
}
