<?php

namespace Amphibee\MariusApi\Facades;

use Amphibee\MariusApi\Services\CampusService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getCampuses()
 *
 * @see \Amphibee\MariusApi\Services\CampusService
 */
class Campus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CampusService::class;
    }
}
