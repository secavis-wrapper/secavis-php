<?php

namespace SecavisWrapper\SecavisPHP\Request;

abstract class Request
{
    /**
     * URL du service de vérification des avis d'imposition
     */
    const URL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/commun/index.jsf';
    
    /**
     * Paramètre de la requête HTTP
     */
    const OPTIONS = [
        'http' => [
            'method' => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => []
        ]
    ];

    public static function send(string $numeroFiscal, string $referenceAvis, string $viewState): ?string
    {
        $options = self::OPTIONS;
        $options['http']['content'] = http_build_query([
            'javax.faces.ViewState' => $viewState,
            'j_id_7:spi' => $numeroFiscal,
            'j_id_7:num_facture' => $referenceAvis,
            'j_id_7_SUBMIT' => 1,
            'j_id_7:j_id_l' => 'Valider'
        ]);

        try {
            $context  = stream_context_create($options);
            $response = file_get_contents(self::URL, false, $context);

            return $response;
        } catch (\Throwable $th) {
            throw new \Exception('Echec de la requête');
        }
    } 

}
