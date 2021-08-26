<?php

namespace SecavisWrapper\SecavisPHP;

use SecavisWrapper\SecavisPHP\Model\FoyerFiscal;
use SecavisWrapper\SecavisPHP\Request\PreRequest;
use SecavisWrapper\SecavisPHP\Request\Request;
use SecavisWrapper\SecavisPHP\Utils\Parser;
use SecavisWrapper\SecavisPHP\DataTransformer\FoyerFiscalDataTransformer;

class SecavisPHP
{
    /**
     * Statut
     * 
     * @var bool
     */
    private $status = false;

    /**
     * ViewState
     * 
     * @var string|null
     */
    private $viewState = null;

    /**
     * Réponse de la requête
     * 
     * @var string|null
     */
    private $response = null;

    /**
     * Numéro fiscal du déclarant
     * 
     * @var string|null
     */
    private $numeroFiscal = null;

    /**
     * Référence de l'avis d'imposition
     * 
     * @var string|null
     */
    private $referenceAvis = null;

    public function init(string $numeroFiscal, string $referenceAvis): ?FoyerFiscal
    {
        if (!$this->response || !$this->status
            || $this->getNumeroFiscal() !== $numeroFiscal
            || $this->getReferenceAvis() !== $referenceAvis
        ) {
            $this->numeroFiscal = $numeroFiscal;
            $this->referenceAvis = $referenceAvis;

            // Pre-request
            $response = PreRequest::send();
            $dom = new \DOMDocument();
            $dom->loadHTML($response);
            $this->viewState = Parser::getViewStateFromHtml($dom);

            // Request
            $this->response = Request::send($numeroFiscal, $referenceAvis, $this->viewState);
            $this->status = true;
        }
        return $this->getData();
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getViewState(): ?string
    {
        return $this->viewState;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function getDomFromResponse(): ?\DOMDocument
    {
        if ($this->response) {
            $dom = new \DOMDocument();
            $dom->loadHTML($this->response);

            return $dom;
        }
        return null;
    }

    public function getData(bool $toArray = false): mixed
    {
        if ($data = $this->response ? Parser::getDataFromHtml($this->getDomFromResponse()) : null) {
            return $toArray ? $data : FoyerFiscalDataTransformer::fromArray($data, $this->numeroFiscal, $this->referenceAvis);
        }
        return null;
    }

    public function getNumeroFiscal(): ?string
    {
        return $this->numeroFiscal;
    }

    public function getReferenceAvis(): ?string
    {
        return $this->referenceAvis;
    }

}
