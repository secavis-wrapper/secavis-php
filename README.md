# Secavis PHP

Interface PHP de communication avec le service de vérification du justificatif et de l'avis d'impôt sur le revenu.

## Installation

```
composer require studio-package/secavis-php
```

## Utilisation

```
use Secavis\Secavis;

$numeroFiscal = 'xxxxxxxxxxxxx';
$referenceAvisFiscal = 'xxxxxxxxxxxxx';

$data = Secavis::get($numeroFiscal, $referenceAvisFiscal);
```

## Modèle

### Data

```
Data {
    /* Propriétés */
    private array $declarants;
    private string $dateRecouvrement;
    private string $dateEtablissement;
    private float $parts;
    private string $situationConjugale;
    private int $personnesAcharge;
    private float $revenuBrut;
    private float $revenuImposable;
    private float $revenuFiscal;
    private float $montantImpotNet;
    private float $montantImpot;

    /* Méthodes */
    public getDeclarants(): array;
    public getDateRecouvrement(): string;
    public getDateEtablissement(): string;
    public getParts(): float;
    public getSituationConjugale(): string;
    public getPersonnesAcharges(): int;
    public getRevenuBrut(): float;
    public getRevenuImposable(): float;
    public getRevenuFiscal(): float;
    public getMontantImpotNet(): float;
    public getMontantImpot(): float;
    public toArray(): array;
}
```

### Declarant

```
Declarant {
    /* Propriétés */
    private int $id;
    private string $nom;
    private ?string $nomNaissance;
    private string $prenoms;
    private string $dateNaissance;
    private string $adresse;

    /* Méthodes */
    public getId(): int;
    public getNom(): string;
    public getNomNaissance(): ?string;
    public getPrenoms(): string;
    public getDateNaissance(): string;
    public getAdresse(): string;
    public toArray(): array;
}
```