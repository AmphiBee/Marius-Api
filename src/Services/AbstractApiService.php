<?php

namespace AmphiBee\MariusApi\Services;

use AmphiBee\MariusApi\Exceptions\MariusApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Base service class for API interactions.
 */
abstract class AbstractApiService
{
    /** @var string Base URL for API endpoints */
    protected string $baseUrl;

    /** @var string API authentication key */
    protected string $apiKey;

    /**
     * @param  array{base_url: string, api_key: string, timeout: int}  $config
     */
    public function __construct(array $config)
    {
        $this->baseUrl = $config['base_url'];
        $this->apiKey = $config['api_key'];
    }

    /**
     * Make an HTTP request to the API.
     *
     * @param  string  $method  HTTP method (GET, POST, etc.)
     * @param  string  $endpoint  API endpoint path
     * @param  array  $data  Request data
     *
     * @throws MariusApiException When the API request fails
     */
    protected function makeRequest(string $method, string $endpoint, array $data = []): Response
    {
        $response = Http::asForm()
            ->{strtolower($method)}("{$this->baseUrl}/{$this->apiKey}/{$endpoint}", $data);

        return $response;
    }
}
