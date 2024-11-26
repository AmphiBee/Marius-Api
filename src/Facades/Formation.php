<?php

namespace Amphibee\MariusApi\Facades;

use Amphibee\MariusApi\Services\FormationService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getFormationsByCampus(string $campusId)
 *
 * @see \Amphibee\MariusApi\Services\FormationService
 */
class Formation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FormationService::class;
    }
}
