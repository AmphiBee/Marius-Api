<?php

namespace AmphiBee\MariusApi\DTO;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * Data Transfer Object for Formation information.
 */
class FormationDTO extends DataTransferObject
{
    /** @var string Formation unique identifier */
    public string $id_formation;

    /** @var string Formation name */
    public string $nom_formation;

    /** @var string Formation level */
    public string $niveau_sortie;

    /** @var string Formation year */
    public string $annee;

    /**
     * Create a new FormationDTO instance from array data.
     *
     * @param  array{id_formation: string, nom_formation: string, niveau_sortie: string, annee: string}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self([
            'id_formation' => $data['id_formation'],
            'nom_formation' => $data['nom_formation'],
            'niveau_sortie' => $data['niveau_sortie'],
            'annee' => $data['annee'],
        ]);
    }
}
