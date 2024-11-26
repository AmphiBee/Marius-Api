<?php

namespace Amphibee\MariusApi\Facades;

use Amphibee\MariusApi\Exceptions\MariusApiException;
use Amphibee\MariusApi\Services\CandidatureService;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for Application submission.
 *
 * @method static array{id_candidature: string} submit(CandidatureDTO $candidature) Submit a new application
 *
 * @throws MariusApiException When API request fails
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
