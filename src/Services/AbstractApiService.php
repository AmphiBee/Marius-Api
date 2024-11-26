<?php

namespace Amphibee\MariusApi\Services;

use Amphibee\MariusApi\Exceptions\MariusApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class AbstractApiService
{
    protected string $baseUrl;

    protected string $apiKey;

    protected int $timeout;

    public function __construct(array $config)
    {
        $this->baseUrl = $config['base_url'];
        $this->apiKey = $config['api_key'];
        $this->timeout = $config['timeout'];
    }

    protected function makeRequest(string $method, string $endpoint, array $data = []): Response
    {
        $response = Http::timeout($this->timeout)
            ->withToken($this->apiKey)
            ->{strtolower($method)}("{$this->baseUrl}/{$endpoint}", $data);

        if ($response->failed()) {
            throw new MariusApiException(
                "L'appel API a échoué : {$response->status()} - {$response->body()}"
            );
        }

        return $response;
    }
}
