<?php

namespace AmphiBee\MariusApi\DTO;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * Data Transfer Object for Application submission.
 */
class CandidatureDTO extends DataTransferObject
{
    /** @var string Title (Madame/Monsieur) */
    public string $civilite;

    /** @var string Last name */
    public string $nom;

    /** @var string First name */
    public string $prenom;

    /** @var string Email address */
    public string $email;

    /** @var string Phone number */
    public string $portable;

    /** @var string Selected campus ID */
    public string $id_campus;

    /** @var string Selected formation ID */
    public string $id_formation;

    /**
     * Create a new CandidatureDTO instance from array data.
     *
     * @param  array{civilite: string, nom: string, prenom: string, email: string, portable: string, id_campus: string, id_formation: string}  $data
     */
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
