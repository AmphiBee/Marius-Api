<?php

namespace AmphiBee\MariusApi\Services;

use AmphiBee\MariusApi\DTO\FormationDTO;
use AmphiBee\MariusApi\Exceptions\MariusApiException;

/**
 * Service for managing formation data.
 * Handles retrieval of formations by campus from the Marius API.
 */
class FormationService extends AbstractApiService
{
    private mixed $rawResponse = null;

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
        $this->rawResponse = $response->json();
        $data = $this->rawResponse['campus'][$campusId]['formations'] ?? [];

        return array_map(
            fn (array $formation): FormationDTO => FormationDTO::fromArray($formation),
            $data
        );
    }

    /**
     * Retourne la dernière réponse brute de l'API.
     *
     * @return mixed La réponse brute de la dernière requête ou null si aucune requête n'a été effectuée
     */
    public function getRawResponse(): mixed
    {
        return $this->rawResponse;
    }
}
