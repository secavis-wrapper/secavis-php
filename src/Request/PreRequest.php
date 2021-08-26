<?php

namespace SecavisWrapper\SecavisPHP\Request;

abstract class PreRequest
{
    /**
     * URL du service de vérification des avis d'imposition
     */
    const URL = 'https://cfsmsp.impots.gouv.fr/secavis';

    /**
     * Paramètre de la requête HTTP
     */
    const OPTIONS = [
        'http' => [
            'method' => 'GET'
        ]
    ];

    public static function send(): ?string
    {
        $context  = stream_context_create(self::OPTIONS);
        $response = file_get_contents(self::URL, false, $context);

        try {
            $context  = stream_context_create(self::OPTIONS);
            $response = file_get_contents(self::URL, false, $context);

            return $response;
        } catch (\Throwable $th) {
            throw new \Exception('Echec de la requête');
        }
    } 

}
