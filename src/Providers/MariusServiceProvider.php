<?php

namespace Amphibee\MariusApi\Providers;

use Amphibee\MariusApi\Services\CampusService;
use Amphibee\MariusApi\Services\CandidatureService;
use Amphibee\MariusApi\Services\FormationService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class MariusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/marius.php', 'marius');

        // Register services as singletons
        $this->app->singleton(CampusService::class, fn (Application $app): \Amphibee\MariusApi\Services\CampusService => new CampusService($app['config']['marius']));

        $this->app->singleton(FormationService::class, fn (Application $app): \Amphibee\MariusApi\Services\FormationService => new FormationService($app['config']['marius']));

        $this->app->singleton(CandidatureService::class, fn (Application $app): \Amphibee\MariusApi\Services\CandidatureService => new CandidatureService($app['config']['marius']));
    }

    public function provides(): array
    {
        return [
            CampusService::class,
            FormationService::class,
            CandidatureService::class,
        ];
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/marius.php' => config_path('marius.php'),
        ], 'marius-config');
    }
}
