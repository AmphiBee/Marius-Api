<?php

namespace Amphibee\MariusApi\Services;

use Amphibee\MariusApi\DTO\FormationDTO;

class FormationService extends AbstractApiService
{
    /**
     * @return FormationDTO[]
     *
     * @throws \Amphibee\MariusApi\Exceptions\MariusApiException
     */
    public function getFormationsByCampus(string $campusId): array
    {
        $response = $this->makeRequest('GET', 'formations');
        $data = $response->json()['campus'][$campusId]['formations'] ?? [];

        return array_map(
            fn (array $formation): \Amphibee\MariusApi\DTO\FormationDTO => FormationDTO::fromArray($formation),
            $data
        );
    }
}
