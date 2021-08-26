<?php

namespace SecavisWrapper\SecavisPHP\Model;

class FoyerFiscal
{
    /**
     * Numéro fiscal du déclarant
     * 
     * @var string|null
     */
    private $numeroFiscal = null;

    /**
     * Adresse du foyer fiscal
     * 
     * @var array
     */
    private $adresse = [];

    /**
     * Liste des déclarants
     * 
     * @var array
     */
    private $declarants = [];

    /**
     * Avis d'imposition
     * 
     * @var Avis|null
     */
    private $avis = null;

    public function getNumeroFiscal(): ?string
    {
        return $this->numeroFiscal;
    }

    public function setNumeroFiscal(?string $numeroFiscal): self
    {
        $this->numeroFiscal = $numeroFiscal;

        return $this;
    }

    public function getAdresse(): ?array
    {
        return $this->adresse;
    }

    public function setAdresse(?array $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDeclarants(): array
    {
        return $this->declarants;
    }

    public function addDeclarant(Declarant $declarant): self
    {
        $this->declarants[] = $declarant;

        return $this;
    }

    public function getAvis(): ?Avis
    {
        return $this->avis;
    }

    public function setAvis(?Avis $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getReferenceAvis(): ?string
    {
        return $this->avis ? $this->avis->getReference() : null;
    }

}
