<?php

namespace SecavisWrapper\SecavisPHP\Model;

class Avis
{
    /**
     * Référence de l'avis d'imposition
     * 
     * @var string|null
     */
    private $reference = null;

    /**
     * Date de mise en recouvrement de l'avis d'impôt
     * 
     * @var string|null
     */
    private $dateRecouvrement = null;

    /**
     * Date d'établissement	
     * 
     * @var string|null
     */
    private $dateEtablissement = null;

    /**
     * Nombre de part(s)
     * 
     * @var float|null
     */
    private $parts = null;

    /**
     * Situation de famille
     * 
     * @var string|null
     */
    private $situationFamille = null;

    /**
     * Nombre de personne(s) à charge
     * 
     * @var int|null
     */
    private $personnesCharge = null;

    /**
     * Revenu brut global
     * 
     * @var float|null
     */
    private $revenuBrut = null;

    /**
     * Revenu imposable
     * 
     * @var float|null
     */
    private $revenuImposable = null;

    /**
     * Impôt sur le revenu net avant corrections
     * 
     * @var float|null
     */
    private $montantImpotNet = null;

    /**
     * Montant de l'impôt
     * 
     * @var float|null
     */
    private $montantImpot = null;

    /**
     * Revenu fiscal de référence
     * 
     * @var float|null
     */
    private $revenuFiscal = null;

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDateRecouvrement(): ?string
    {
        return $this->dateRecouvrement;
    }

    public function setDateRecouvrement(?string $dateRecouvrement): self
    {
        $this->dateRecouvrement = $dateRecouvrement;

        return $this;
    }

    public function getDateEtablissement(): ?string
    {
        return $this->dateEtablissement;
    }

    public function setDateEtablissement(?string $dateEtablissement): self
    {
        $this->dateEtablissement = $dateEtablissement;

        return $this;
    }

    public function getParts(): ?float
    {
        return $this->parts;
    }

    public function setParts(?float $parts): self
    {
        $this->parts = $parts;

        return $this;
    }

    public function getSituationFamille(): ?string
    {
        return $this->situationFamille;
    }

    public function setSituationFamille(?string $situationFamille): self
    {
        $this->situationFamille = $situationFamille;

        return $this;
    }

    public function getPersonnesCharges(): ?int
    {
        return $this->personnesCharge;
    }

    public function setPersonnesCharges(?int $personnesCharge): self
    {
        $this->personnesCharge = $personnesCharge;

        return $this;
    }

    public function getRevenuBrut(): ?float
    {
        return $this->revenuBrut;
    }

    public function setRevenuBrut(?float $revenuBrut): self
    {
        $this->revenuBrut = $revenuBrut;

        return $this;
    }

    public function getRevenuImposable(): ?float
    {
        return $this->revenuImposable;
    }

    public function setRevenuImposable(?float $revenuImposable): self
    {
        $this->revenuImposable = $revenuImposable;

        return $this;
    }

    public function getRevenuFiscal(): ?float
    {
        return $this->revenuFiscal;
    }

    public function setRevenuFiscal(?float $revenuFiscal): self
    {
        $this->revenuFiscal = $revenuFiscal;

        return $this;
    }

    public function getMontantImpotNet(): ?float
    {
        return $this->montantImpotNet;
    }

    public function setMontantImpotNet(?float $montantImpotNet): self
    {
        $this->montantImpotNet = $montantImpotNet;

        return $this;
    }

    public function getMontantImpot(): ?float
    {
        return $this->montantImpot;
    }

    public function setMontantImpot(?float $montantImpot): self
    {
        $this->montantImpot = $montantImpot;

        return $this;
    }

    public function getAnnee(): ?string
    {
        if ($this->reference && \strlen($this->reference) >= 2 && \preg_match('/^[0-9]*$/', \substr($this->reference, 0, 2))) {
            return '20' . \substr($this->reference, 0, 2);
        }
        return null;
    }

}
