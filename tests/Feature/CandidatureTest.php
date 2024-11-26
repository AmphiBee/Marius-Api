<?php

use AmphiBee\MariusApi\DTO\CandidatureDTO;
use AmphiBee\MariusApi\Services\CandidatureService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

beforeEach(function (): void {
    $this->service = app(CandidatureService::class);
});

it(/**
 * @throws UnknownProperties
 */ 'can submit candidature', function (): void {
    // Arrange
    Http::fake([
        '*/candidature' => Http::response([
            'id_candidature' => '123',
        ]),
    ]);

    $candidature = new CandidatureDTO([
        'civilite' => 'Monsieur',
        'nom' => 'Doe',
        'prenom' => 'John',
        'email' => 'john@example.com',
        'portable' => '0612345678',
        'id_campus' => '1',
        'id_formation' => '30',
    ]);

    // Act
    $response = $this->service->submit($candidature);

    // Assert
    expect($response)
        ->toBeArray()
        ->toHaveKey('id_candidature')
        ->and($response['id_candidature'])->toBe('123');

    Http::assertSent(fn (Request $request): bool => $request->url() === config('marius.base_url').'/candidature' &&
        $request->method() === 'POST' &&
        $request['civilite'] === 'Monsieur' &&
        $request['nom'] === 'Doe');
});

it('throws exception when candidature submission fails', function (): void {
    Http::fake([
        '*/candidature' => Http::response(null, 422),
    ]);

    $candidature = new CandidatureDTO([
        'civilite' => 'Monsieur',
        'nom' => 'Doe',
        'prenom' => 'John',
        'email' => 'john@example.com',
        'portable' => '0612345678',
        'id_campus' => '1',
        'id_formation' => '30',
    ]);

    $this->service->submit($candidature);
})->throws(\AmphiBee\MariusApi\Exceptions\MariusApiException::class);
