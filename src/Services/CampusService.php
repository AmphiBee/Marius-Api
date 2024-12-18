<?php

namespace AmphiBee\MariusApi\Services;

use AmphiBee\MariusApi\DTO\CampusDTO;
use AmphiBee\MariusApi\Exceptions\MariusApiException;

/**
 * Service for managing campus data.
 */
class CampusService extends AbstractApiService
{
    private mixed $rawResponse = null;

    /**
     * Get list of all available campuses with their formations.
     *
     * @return CampusDTO[] Array of campus objects
     *
     * @throws MariusApiException
     */
    public function getCampuses(): array
    {
        $response = $this->makeRequest('GET', 'formations');
        $this->rawResponse = $response->json();
        $data = $this->rawResponse['campus'];

        return array_map(
            fn (array $campus): \AmphiBee\MariusApi\DTO\CampusDTO => CampusDTO::fromArray($campus),
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
