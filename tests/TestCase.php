<?php

namespace AmphiBee\MariusApi\Tests;

use AmphiBee\MariusApi\Providers\MariusServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            MariusServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('marius.api_key', 'test-key');
    }
}
