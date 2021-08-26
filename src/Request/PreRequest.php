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

    public static function send(): \DOMDocument
    {
        $context  = stream_context_create(self::OPTIONS);
        $response = file_get_contents(self::URL, false, $context);

        if (!$response) {
            throw new \Exception('Echec de la requête');
        }
        $dom = new \DOMDocument();
        $dom->loadHTML($response);

        return $dom;
    } 

}
