<?php

namespace AmphiBee\MariusApi\DTO;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * Data Transfer Object for Campus information.
 */
class CampusDTO extends DataTransferObject
{
    /** @var string Campus unique identifier */
    public string $id_campus;

    /** @var string Campus name */
    public string $campus;

    /** @var FormationDTO[] List of formations available for this campus */
    public array $formations;

    /**
     * Create a new CampusDTO instance from array data.
     *
     * @param  array{id_campus: string, campus: string, formations: array}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self([
            'id_campus' => $data['id_campus'],
            'campus' => $data['campus'],
            'formations' => array_map(
                fn (array $formation): FormationDTO => FormationDTO::fromArray($formation),
                $data['formations']
            ),
        ]);
    }
}
