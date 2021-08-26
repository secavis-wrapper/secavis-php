<?php

namespace SecavisWrapper\SecavisPHP\Utils;

abstract class Parser
{
    const DATA = [
        'adresse' => null,
        'declarants' => [
            [
                'nom' => null,
                'nomNaissance' => null,
                'prenoms' => null,
                'dateNaissance' => null
            ],
            [
                'nom' => null,
                'nomNaissance' => null,
                'prenoms' => null,
                'dateNaissance' => null
            ]
        ],
        'avis' => [
            'dateRecouvrement' => null,
            'dateEtablissement' => null,
            'parts' => null,
            'situationFamille' => null,
            'personnesCharge' => null,
            'revenuBrut' => null,
            'revenuImposable' => null,
            'montantImpotNet' => null,
            'montantImpot' => null,
            'revenuFiscal' => null
        ]
    ];

    const MAPPING = [
        'dateRecouvrement' => [
            'label' => 'Date de mise en recouvrement de l\'avis d\'impôt',
            'fn' => null
        ],
        'dateEtablissement' => [
            'label' => 'Date d\'établissement',
            'fn' => null
        ],
        'parts' => [
            'label' => 'Nombre de part(s)',
            'fn' => 'toFloat'
        ],
        'situationFamille' => [
            'label' => 'Situation de famille',
            'fn' => null
        ],
        'personnesCharge' => [
            'label' => 'Nombre de personne(s) à charge',
            'fn' => 'toInteger'
        ],
        'revenuBrut' => [
            'label' => 'Revenu brut global',
            'fn' => 'toEuros'
        ],
        'revenuImposable' => [
            'label' => 'Revenu imposable',
            'fn' => 'toEuros'
        ],
        'montantImpotNet' => [
            'label' => 'Impôt sur le revenu net avant corrections',
            'fn' => 'getImpot'
        ],
        'montantImpot' => [
            'label' => 'Montant de l\'impôt',
            'fn' => 'getImpot'
        ],
        'revenuFiscal' => [
            'label' => 'Revenu fiscal de référence',
            'fn' => 'toEuros'
        ]
    ];

    const MAPPING_DECLARANT = [
        'nom' => 'Nom',
        'nomNaissance' => 'Nom de naissance',
        'prenoms' => 'Prénom(s)',
        'dateNaissance' => 'Date de naissance'
    ];

    /**
     * Retourne la valeur ViewState depuis une réponse HTML
     */
    public static function getViewStateFromHtml(\DOMDocument $dom): ?string
    {
        $el = $dom->getElementById('j_id__v_0:javax.faces.ViewState:1');
        return $el ? $el->getAttribute('value') : null;
    }

    /**
     * Retourne les données extraites depuis une réponse HTML
     */
    public static function getDataFromHtml(\DOMDocument $dom): array
    {
        $data = self::DATA;
        
        // Tableau principal
        $finder = new \DomXPath($dom);
        $rowList = $finder->query('//*[@id="principal"]//table//tr');

        // Mapping des données
        $mappingKeys = \array_map(function($item) {
            return $item['label'];
        }, self::MAPPING);

        // Extraction des données
        for ($i=0; $i < $rowList->length; $i++) { 
            /** @var \DOMElement */
            $row = $rowList->item($i);

            $cells = $row->getElementsByTagName('td');
            $rowLabel = $cells->item(0);

            if ($rowLabel && $key = \array_search(\trim($rowLabel->textContent), self::MAPPING_DECLARANT)) {
                for ($k=0; $k <= 1; $k++) { 
                    $content = \trim($cells->item($k + 1)->textContent);
                    $data['declarants'][$k][$key] = !empty($content) ? $content : null;
                }
            } elseif ($rowLabel && $key = \array_search(\trim($rowLabel->textContent), $mappingKeys)) {
                if ($cells->item(1)) {
                    if ($method = self::MAPPING[$key]['fn']) {
                        $data['avis'][$key] = self::$method($cells->item(1)->textContent);
                    } else {
                        $data['avis'][$key] = \trim($cells->item(1)->textContent);
                    }
                } else {
                    $data['avis'][$key] = null;
                }
            }
        }
        // Extraction de l'adresse
        foreach ([5, 6, 7] as $index) {
            /** @var \DOMElement */
            $row = $rowList->item($index);

            $cells = $row->getElementsByTagName('td');
            $cell = $cells->item(1);

            if ($cell && $cell->textContent) {
                $data['adresse'][] = \trim($cell->textContent);
            }
        }

        return $data;
    }

    public static function toEuros(?string $value): int
    {
        return $value ? (int) \preg_replace('/\D/', '', $value) : 0;
    }

    public static function toFloat(?string $value): float
    {
        return $value ? (float) $value : 0;
    }

    public static function toInteger(?string $value): int
    {
        return $value ? (int) $value : 0;
    }

    public static function getImpot(?string $value): ?float
    {
        return \trim($value) === 'Non imposable' ? null : self::toEuros($value);
    }

}
