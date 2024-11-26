<?php

namespace Amphibee\MariusApi\Services;

use Amphibee\MariusApi\DTO\CandidatureDTO;

class CandidatureService extends AbstractApiService
{
    /**
     * @throws \Amphibee\MariusApi\Exceptions\MariusApiException
     */
    public function submit(CandidatureDTO $candidature): array
    {
        $response = $this->makeRequest('POST', 'candidature', $candidature->toArray());

        return $response->json();
    }
}
