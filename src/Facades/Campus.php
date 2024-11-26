<?php

namespace Amphibee\MariusApi\Facades;

use Amphibee\MariusApi\DTO\CampusDTO;
use Amphibee\MariusApi\Exceptions\MariusApiException;
use Amphibee\MariusApi\Services\CampusService;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for Campus API interactions.
 *
 * @method static CampusDTO[] getCampuses() Get list of all available campuses with their formations
 *
 * @throws MariusApiException When API request fails
 *
 * @see CampusService
 */
class Campus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CampusService::class;
    }
}
