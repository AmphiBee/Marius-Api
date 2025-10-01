<?php

namespace AmphiBee\MariusApi\Services;

use AmphiBee\MariusApi\DTO\CandidatureDTO;
use AmphiBee\MariusApi\Exceptions\MariusApiException;

/**
 * Service for managing application submissions.
 */
class CandidatureService extends AbstractApiService
{
    private mixed $rawResponse = null;

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

        return array_merge(['code' => $response->status()], $response->json());
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
