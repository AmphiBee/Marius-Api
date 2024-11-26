<?php

namespace Amphibee\MariusApi\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class FormationDTO extends DataTransferObject
{
    public string $id_formation;

    public string $nom_formation;

    public string $niveau_sortie;

    public static function fromArray(array $data): self
    {
        return new self([
            'id_formation' => $data['id_formation'],
            'nom_formation' => $data['nom_formation'],
            'niveau_sortie' => $data['niveau_sortie'],
        ]);
    }
}
