<?php

namespace Amphibee\MariusApi\Facades;

use Amphibee\MariusApi\Services\CandidatureService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array submit(\Amphibee\MariusApi\DTO\CandidatureDTO $candidature)
 *
 * @see \Amphibee\MariusApi\Services\CandidatureService
 */
class Candidature extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CandidatureService::class;
    }
}
