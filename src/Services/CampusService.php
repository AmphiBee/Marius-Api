<?php

namespace Amphibee\MariusApi\Services;

use Amphibee\MariusApi\DTO\CampusDTO;
use Amphibee\MariusApi\Exceptions\MariusApiException;

/**
 * Service for managing campus data.
 */
class CampusService extends AbstractApiService
{
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
        $data = $response->json()['campus'];

        return array_map(
            fn (array $campus): \Amphibee\MariusApi\DTO\CampusDTO => CampusDTO::fromArray($campus),
            $data
        );
    }
}
