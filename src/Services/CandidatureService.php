<?php

namespace AmphiBee\MariusApi\Services;

use AmphiBee\MariusApi\DTO\CandidatureDTO;
use AmphiBee\MariusApi\Exceptions\MariusApiException;

/**
 * Service for managing application submissions.
 */
class CandidatureService extends AbstractApiService
{
    /**
     * Submit a new application.
     *
     * @param  CandidatureDTO  $candidature  Application data
     * @return array{id_candidature: string} Response containing the application ID
     *
     * @throws MariusApiException
     */
    public function submit(CandidatureDTO $candidature): array
    {
        $response = $this->makeRequest('POST', 'candidature', $candidature->toArray());

        return $response->json();
    }
}
