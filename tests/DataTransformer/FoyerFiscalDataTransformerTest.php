<?php

namespace SecavisWrapper\SecavisPHP\Tests\DataTransformer;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\DataTransformer\FoyerFiscalDataTransformer;
use SecavisWrapper\SecavisPHP\Model\Avis;
use SecavisWrapper\SecavisPHP\Model\Declarant;
use SecavisWrapper\SecavisPHP\Model\FoyerFiscal;

class FoyerFiscalDataTransformerTest extends TestCase
{
    const MOCK_DATA = [
        'adresse' => [ 'test', 'test', 'test'],
        'declarants' => [
            [
                'nom' => 'DOE',
                'nomNaissance' => 'DOE',
                'prenoms' => 'JOHN',
                'dateNaissance' => '01/01/1990'
            ],
            [
                'nom' => 'DOE',
                'nomNaissance' => 'DOE',
                'prenoms' => 'JOHN',
                'dateNaissance' => '01/01/1990'
            ]
        ],
        'avis' => [
            'dateRecouvrement' => '01/01/1990',
            'dateEtablissement' => '01/01/1990',
            'parts' => 1.5,
            'situationFamille' => 'Célibataire',
            'personnesCharge' => 1,
            'revenuBrut' => 1,
            'revenuImposable' => 1,
            'montantImpotNet' => 1,
            'montantImpot' => 1,
            'revenuFiscal' => 1
        ]
    ];

    public function testFromArrayInvalid(): void
    {
        $this->assertInstanceOf(FoyerFiscal::class, FoyerFiscalDataTransformer::fromArray());
    }

    public function testFromArrayValid(): void
    {
        $data = FoyerFiscalDataTransformer::fromArray(self::MOCK_DATA, 'test', 'test');

        $this->assertInstanceOf(FoyerFiscal::class, $data);

        $this->assertEquals($data->getNumeroFiscal(), 'test');
        $this->assertEquals(\count($data->getAdresse()), 3);
        $this->assertEquals($data->getAdresse()[0], self::MOCK_DATA['adresse'][0]);
        $this->assertEquals($data->getAdresse()[1], self::MOCK_DATA['adresse'][1]);
        $this->assertEquals($data->getAdresse()[2], self::MOCK_DATA['adresse'][2]);
        $this->assertEquals(\count($data->getDeclarants()), 2);

        $this->assertInstanceOf(Declarant::class, $data->getDeclarants()[0]);
        $this->assertEquals($data->getDeclarants()[0]->getNom(), self::MOCK_DATA['declarants'][0]['nom']);
        $this->assertEquals($data->getDeclarants()[0]->getNomNaissance(), self::MOCK_DATA['declarants'][0]['nomNaissance']);
        $this->assertEquals($data->getDeclarants()[0]->getPrenoms(), self::MOCK_DATA['declarants'][0]['prenoms']);
        $this->assertEquals($data->getDeclarants()[0]->getDateNaissance(), self::MOCK_DATA['declarants'][0]['dateNaissance']);
        
        $this->assertInstanceOf(Declarant::class, $data->getDeclarants()[1]);
        $this->assertEquals($data->getDeclarants()[1]->getNom(), self::MOCK_DATA['declarants'][1]['nom']);
        $this->assertEquals($data->getDeclarants()[1]->getNomNaissance(), self::MOCK_DATA['declarants'][1]['nomNaissance']);
        $this->assertEquals($data->getDeclarants()[1]->getPrenoms(), self::MOCK_DATA['declarants'][1]['prenoms']);
        $this->assertEquals($data->getDeclarants()[1]->getDateNaissance(), self::MOCK_DATA['declarants'][1]['dateNaissance']);

        $this->assertInstanceOf(Avis::class, $data->getAvis());
        $this->assertEquals($data->getAvis()->getReference(), 'test');
        $this->assertEquals($data->getAvis()->getDateRecouvrement(), self::MOCK_DATA['avis']['dateRecouvrement']);
        $this->assertEquals($data->getAvis()->getDateEtablissement(), self::MOCK_DATA['avis']['dateEtablissement']);
        $this->assertEquals($data->getAvis()->getParts(), self::MOCK_DATA['avis']['parts']);
        $this->assertEquals($data->getAvis()->getSituationFamille(), self::MOCK_DATA['avis']['situationFamille']);
        $this->assertEquals($data->getAvis()->getPersonnesCharges(), self::MOCK_DATA['avis']['personnesCharge']);
        $this->assertEquals($data->getAvis()->getRevenuBrut(), self::MOCK_DATA['avis']['revenuBrut']);
        $this->assertEquals($data->getAvis()->getRevenuImposable(), self::MOCK_DATA['avis']['revenuImposable']);
        $this->assertEquals($data->getAvis()->getRevenuFiscal(), self::MOCK_DATA['avis']['revenuFiscal']);
        $this->assertEquals($data->getAvis()->getMontantImpotNet(), self::MOCK_DATA['avis']['montantImpotNet']);
        $this->assertEquals($data->getAvis()->getMontantImpot(), self::MOCK_DATA['avis']['montantImpot']);
    }

}
