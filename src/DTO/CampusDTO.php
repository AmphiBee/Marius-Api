<?php

namespace Amphibee\MariusApi\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CampusDTO extends DataTransferObject
{
    public string $id_campus;

    public string $campus;

    /** @var FormationDTO[] */
    public array $formations;

    public static function fromArray(array $data): self
    {
        return new self([
            'id_campus' => $data['id_campus'],
            'campus' => $data['campus'],
            'formations' => array_map(
                fn (array $formation): \Amphibee\MariusApi\DTO\FormationDTO => FormationDTO::fromArray($formation),
                $data['formations']
            ),
        ]);
    }
}
