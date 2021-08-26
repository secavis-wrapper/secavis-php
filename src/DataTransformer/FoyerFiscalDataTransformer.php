<?php

namespace SecavisWrapper\SecavisPHP\DataTransformer;

use SecavisWrapper\SecavisPHP\Model\Avis;
use SecavisWrapper\SecavisPHP\Model\Declarant;
use SecavisWrapper\SecavisPHP\Model\FoyerFiscal;

abstract class FoyerFiscalDataTransformer
{
    public static function fromArray(array $data): FoyerFiscal
    {
        $model = new FoyerFiscal();

        self::setAdresse($model, $data);
        self::setDeclarants($model, $data);
        self::setAvis($model, $data);

        return $model;
    }

    private static function setAdresse(FoyerFiscal $model, array $data): FoyerFiscal
    {
        if (\array_key_exists('adresse', $data) && \is_array($data['adresse'])) {
            $model->setAdresse($data['adresse']);
        }
        return $model;
    }

    private static function setDeclarants(FoyerFiscal $model, array $data): FoyerFiscal
    {
        if (\array_key_exists('declarants', $data) && \is_array($data['declarants'])) {
            foreach ($data['declarants'] as $row) {
                if (\array_key_exists('nom', $row) && !empty($row['nom'])) {
                    $declarant = (new Declarant())
                        ->setNom($row['nom'] ?? null)
                        ->setNomNaissance($row['nomNaissance'] ?? null)
                        ->setPrenoms($row['prenoms'] ?? null)
                        ->setDateNaissance($row['dateNaissance'] ?? null);
                    $model->addDeclarant($declarant);
                }
            }
        }
        return $model;
    }

    private static function setAvis(FoyerFiscal $model, array $data): FoyerFiscal
    {
        if (\array_key_exists('avis', $data) && \is_array($data['avis'])) {
            $avis = (new Avis())
                ->setDateRecouvrement($data['avis']['dateRecouvrement'] ?? null)
                ->setDateEtablissement($data['avis']['dateEtablissement'] ?? null)
                ->setParts($data['avis']['parts'] ?? null)
                ->setSituationFamille($data['avis']['situationFamille'] ?? null)
                ->setPersonnesCharges($data['avis']['personnesCharge'] ?? null)
                ->setRevenuBrut($data['avis']['revenuBrut'] ?? null)
                ->setRevenuImposable($data['avis']['revenuImposable'] ?? null)
                ->setMontantImpotNet($data['avis']['montantImpotNet'] ?? null)
                ->setMontantImpot($data['avis']['montantImpot'] ?? null)
                ->setRevenuFiscal($data['avis']['revenuFiscal'] ?? null);
            $model->setAvis($avis);
        }
        return $model;
    }

}
