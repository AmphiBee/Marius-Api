<?php

namespace Amphibee\MariusApi\Services;

use Amphibee\MariusApi\DTO\FormationDTO;
use Amphibee\MariusApi\Exceptions\MariusApiException;

/**
 * Service for managing formation data.
 * Handles retrieval of formations by campus from the Marius API.
 */
class FormationService extends AbstractApiService
{
    /**
     * Get all formations available for a specific campus.
     *
     * @param  string  $campusId  The unique identifier of the campus
     * @return FormationDTO[] Array of formations associated with the campus
     *
     * @throws MariusApiException When API request fails or campus not found
     */
    public function getFormationsByCampus(string $campusId): array
    {
        $response = $this->makeRequest('GET', 'formations');
        $data = $response->json()['campus'][$campusId]['formations'] ?? [];

        return array_map(
            fn (array $formation): FormationDTO => FormationDTO::fromArray($formation),
            $data
        );
    }
}
