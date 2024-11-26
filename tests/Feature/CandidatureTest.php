<?php

use Amphibee\MariusApi\DTO\CandidatureDTO;
use Amphibee\MariusApi\Services\CandidatureService;
use Illuminate\Support\Facades\Http;

beforeEach(function (): void {
    $this->service = app(CandidatureService::class);
});

it('can submit candidature', function (): void {
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

    Http::assertSent(fn (\Illuminate\Http\Client\Request $request): bool => $request->url() === config('marius.base_url').'/candidature' &&
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
})->throws(\Amphibee\MariusApi\Exceptions\MariusApiException::class);
