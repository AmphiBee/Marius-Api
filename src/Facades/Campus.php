<?php

namespace AmphiBee\MariusApi\Facades;

use AmphiBee\MariusApi\DTO\CampusDTO;
use AmphiBee\MariusApi\Exceptions\MariusApiException;
use AmphiBee\MariusApi\Services\CampusService;
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
