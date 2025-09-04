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
     * @var UTM source GET parameter
     */
    public ?string $utm_source;

    /**
     * @var UTM medium GET parameter
     */
    public ?string $utm_medium;

    /**
     * @var UTM campaign GET parameter
     */
    public ?string $utm_campaign;

    /**
     * @var Tiktok Ad GET parameter
     */
    public ?string $ad_click_id_tiktok;

    /**
     * @var Snapchat Ad GET parameter
     */
    public ?string $ad_click_id_snapchat;

    /**
     * @var Meta Ad GET parameter
     */
    public ?string $ad_click_id_meta;

    /**
     * @var LinkedIn Ad GET parameter
     */
    public ?string $ad_click_id_linkedin;

    /**
     * @var Google Ad GET parameter
     */
    public ?string $ad_click_id_google;

    /**
     * Create a new CandidatureDTO instance from array data.
     *
     * @param  array{civilite: string, nom: string, prenom: string, email: string, portable: string, id_campus: string,
     *     id_formation: string, utm_source: string, utm_medium: string, utm_campaign: string, ad_click_id_tiktok: string,
     *     ad_click_id_snapchat: string, ad_click_id_meta: string, ad_click_id_linkedin: string, ad_click_id_google: string} $data
     */
    public static function fromArray(array $data): self
    {
        return new self([
            'civilite'             => $data['civilite'],
            'nom'                  => $data['nom'],
            'prenom'               => $data['prenom'],
            'email'                => $data['email'],
            'portable'             => $data['portable'],
            'id_campus'            => $data['id_campus'],
            'id_formation'         => $data['id_formation'],
            'utm_source'           => $data['utm_source'],
            'utm_medium'           => $data['utm_medium'],
            'utm_campaign'         => $data['utm_campaign'],
            'ad_click_id_tiktok'   => $data['ad_click_id_tiktok'],
            'ad_click_id_snapchat' => $data['ad_click_id_snapchat'],
            'ad_click_id_meta'     => $data['ad_click_id_meta'],
            'ad_click_id_linkedin' => $data['ad_click_id_linkedin'],
            'ad_click_id_google'   => $data['ad_click_id_google'],
        ]);
    }
}
