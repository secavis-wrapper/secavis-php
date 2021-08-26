<?php

namespace SecavisWrapper\SecavisPHP\Model;

class Declarant
{
    /**
     * Nom de famille du déclarant
     * 
     * @var string|null
     */
    private $nom = null;

    /**
     * Nom de famille de naissance du déclarant
     * 
     * @var string|null
     */
    private $nomNaissance = null;

    /**
     * Prénoms du déclarant
     * 
     * @var string|null
     */
    private $prenoms = null;

    /**
     * Date de naissance du déclarant
     * 
     * @var string|null
     */
    private $dateNaissance = null;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNomNaissance(): ?string
    {
        return $this->nomNaissance;
    }

    public function setNomNaissance(?string $nomNaissance): self
    {
        $this->nomNaissance = $nomNaissance;

        return $this;
    }

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(?string $prenoms): self
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getDateNaissance(): ?string
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

}
