<?php

namespace Amphibee\MariusApi\Services;

use Amphibee\MariusApi\DTO\CampusDTO;

class CampusService extends AbstractApiService
{
    /**
     * @return CampusDTO[]
     *
     * @throws \Amphibee\MariusApi\Exceptions\MariusApiException
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
