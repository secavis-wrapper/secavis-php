# Secavis PHP

Interface PHP de communication avec le service de vérification du justificatif et de l'avis d'impôt sur le revenu.

## Installation

```
composer require secavis-wrapper/secavis-php
```

## Utilisation

```
use SecavisWrapper\SecavisPHP;

$numeroFiscal = 'xxxxxxxxxxxxx';
$referenceAvis = 'xxxxxxxxxxxxx';

$service = new SecavisPHP();
$service->init($numeroFiscal, $referenceAvis);
$service->getData();
$service->getStatus();
$service->getResponse();

```
