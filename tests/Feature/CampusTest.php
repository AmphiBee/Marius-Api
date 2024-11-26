<?php

use AmphiBee\MariusApi\DTO\CampusDTO;
use AmphiBee\MariusApi\Exceptions\MariusApiException;
use AmphiBee\MariusApi\Services\CampusService;
use Illuminate\Support\Facades\Http;

beforeEach(function (): void {
    $this->service = app(CampusService::class);
});

it('can fetch campuses from API', function (): void {
    // Arrange
    Http::fake([
        '*/formations' => Http::response([
            'campus' => [
                '1' => [
                    'id_campus' => '1',
                    'campus' => 'Paris',
                    'formations' => [
                        [
                            'id_formation' => '30',
                            'nom_formation' => 'Bachelor Communication',
                            'niveau_sortie' => 'Bac+3',
                        ],
                    ],
                ],
            ],
        ]),
    ]);

    // Act
    $campuses = $this->service->getCampuses();

    // Assert
    expect($campuses)
        ->toBeArray()
        ->toHaveCount(1)
        ->and($campuses[1])
        ->toBeInstanceOf(CampusDTO::class)
        ->and($campuses[1]->id_campus)->toBe('1')
        ->and($campuses[1]->campus)->toBe('Paris')
        ->and($campuses[1]->formations)->toHaveCount(1);
});

it('throws exception when API request fails', function (): void {
    Http::fake([
        '*/formations' => Http::response(null, 500),
    ]);

    $this->service->getCampuses();
})->throws(MariusApiException::class);
