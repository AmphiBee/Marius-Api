<?php

namespace Amphibee\MariusApi\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CandidatureDTO extends DataTransferObject
{
    public string $civilite;

    public string $nom;

    public string $prenom;

    public string $email;

    public string $portable;

    public string $id_campus;

    public string $id_formation;

    public static function fromArray(array $data): self
    {
        return new self([
            'civilite' => $data['civilite'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'portable' => $data['portable'],
            'id_campus' => $data['id_campus'],
            'id_formation' => $data['id_formation'],
        ]);
    }
}
