<?php

namespace SecavisWrapper\SecavisPHP;

use SecavisWrapper\SecavisPHP\Model\FoyerFiscal;
use SecavisWrapper\SecavisPHP\Request\PreRequest;
use SecavisWrapper\SecavisPHP\Request\Request;
use SecavisWrapper\SecavisPHP\Utils\Parser;
use SecavisWrapper\SecavisPHP\DataTransformer\FoyerFiscalDataTransformer;

class Secavis
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
     * @var \DOMDocument|null
     */
    private $response = null;

    /**
     * Données formatées
     * 
     * @var FoyerFiscal|null
     */
    private $data = null;

    public function init(string $numeroFiscal, string $referenceAvis): void
    {
        if ($this->data && ($this->data->getNumeroFiscal() === $numeroFiscal && $this->data->getReferenceAvis() === $referenceAvis)) {
            return;
        }

        $response = PreRequest::send();

        $this->viewState = Parser::getViewStateFromHtml($response);
        $this->response = Request::send($numeroFiscal, $referenceAvis, $this->viewState);
        $this->data = FoyerFiscalDataTransformer::fromArray(Parser::getDataFromHtml($response));
        $this->status = true;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getViewState(): ?string
    {
        return $this->viewState;
    }

    public function getResposne(): ?\DOMDocument
    {
        return $this->response;
    }

    public function getData(): ?FoyerFiscal
    {
        return $this->data;
    }

}
