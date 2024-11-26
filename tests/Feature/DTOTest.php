<?php

use AmphiBee\MariusApi\DTO\CampusDTO;
use AmphiBee\MariusApi\DTO\CandidatureDTO;
use AmphiBee\MariusApi\DTO\FormationDTO;

it('can create campus DTO from array', function (): void {
    $data = [
        'id_campus' => '1',
        'campus' => 'Paris',
        'formations' => [
            [
                'id_formation' => '30',
                'nom_formation' => 'Bachelor Communication',
                'niveau_sortie' => 'Bac+3',
            ],
        ],
    ];

    $campus = CampusDTO::fromArray($data);

    expect($campus)
        ->toBeInstanceOf(CampusDTO::class)
        ->and($campus->id_campus)->toBe('1')
        ->and($campus->campus)->toBe('Paris')
        ->and($campus->formations)->toHaveCount(1)
        ->and($campus->formations[0])->toBeInstanceOf(FormationDTO::class);
});

it('can create formation DTO from array', function (): void {
    $data = [
        'id_formation' => '30',
        'nom_formation' => 'Bachelor Communication',
        'niveau_sortie' => 'Bac+3',
    ];

    $formation = FormationDTO::fromArray($data);

    expect($formation)
        ->toBeInstanceOf(FormationDTO::class)
        ->and($formation->id_formation)->toBe('30')
        ->and($formation->nom_formation)->toBe('Bachelor Communication')
        ->and($formation->niveau_sortie)->toBe('Bac+3');
});

it('can create candidature DTO from array', function (): void {
    $data = [
        'civilite' => 'Monsieur',
        'nom' => 'Doe',
        'prenom' => 'John',
        'email' => 'john@example.com',
        'portable' => '0612345678',
        'id_campus' => '1',
        'id_formation' => '30',
    ];

    $candidature = CandidatureDTO::fromArray($data);

    expect($candidature)
        ->toBeInstanceOf(CandidatureDTO::class)
        ->and($candidature->civilite)->toBe('Monsieur')
        ->and($candidature->nom)->toBe('Doe')
        ->and($candidature->email)->toBe('john@example.com');
});
