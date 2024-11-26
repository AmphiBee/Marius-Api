<?php

namespace Amphibee\MariusApi\Facades;

use Amphibee\MariusApi\DTO\FormationDTO;
use Amphibee\MariusApi\Exceptions\MariusApiException;
use Amphibee\MariusApi\Services\FormationService;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for Formation API interactions.
 *
 * @method static FormationDTO[] getFormationsByCampus(string $campusId) Get formations for a specific campus
 *
 * @throws MariusApiException When API request fails or campus not found
 *
 * @see FormationService
 */
class Formation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FormationService::class;
    }
}
