<?php

use AmphiBee\MariusApi\DTO\FormationDTO;
use AmphiBee\MariusApi\Services\FormationService;
use Illuminate\Support\Facades\Http;

beforeEach(function (): void {
    $this->service = app(FormationService::class);
});

it('can fetch formations by campus', function (): void {
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
                            'annee' => '1ère Année',
                        ],
                        [
                            'id_formation' => '31',
                            'nom_formation' => 'Master Communication',
                            'niveau_sortie' => 'Bac+5',
                            'annee' => '2ème Année',
                        ],
                    ],
                ],
            ],
        ]),
    ]);

    // Act
    $formations = $this->service->getFormationsByCampus('1');

    // Assert
    expect($formations)
        ->toBeArray()
        ->toHaveCount(2)
        ->and($formations[0])
        ->toBeInstanceOf(FormationDTO::class)
        ->and($formations[0]->id_formation)->toBe('30')
        ->and($formations[0]->nom_formation)->toBe('Bachelor Communication')
        ->and($formations[0]->niveau_sortie)->toBe('Bac+3')
        ->and($formations[0]->annee)->toBe('1ère Année');
});

it('returns empty array when campus not found', function (): void {
    Http::fake([
        '*/formations' => Http::response([
            'campus' => [],
        ]),
    ]);

    $formations = $this->service->getFormationsByCampus('999');

    expect($formations)->toBeArray()->toBeEmpty();
});
