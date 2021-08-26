<?php

namespace SecavisWrapper\SecavisPHP\Tests\Utils;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\Utils\Parser;

class ParserTest extends TestCase
{
    const EXPECT_DATA = [
        'adresse' => [
            '1 RUE DU TEST', '76780 LA HAYE'
        ],
        'declarants' => [
            [
                'nom' => 'DOE',
                'nomNaissance' => 'DOE',
                'prenoms' => 'JOHN',
                'dateNaissance' => '01/01/1990'
            ],
            [
                'nom' => 'DOE 2',
                'nomNaissance' => 'DOE 2',
                'prenoms' => 'JOHN 2',
                'dateNaissance' => '01/01/1991'
            ]
        ],
        'avis' => [
            'dateRecouvrement' => '01/01/2020',
            'dateEtablissement' => '01/01/2020',
            'parts' => 2.5,
            'situationFamille' => 'Couple',
            'personnesCharge' => 3,
            'revenuBrut' => 25000,
            'revenuImposable' => 25000,
            'montantImpotNet' => 2500.0,
            'montantImpot' => 2500.0,
            'revenuFiscal' => 25000
        ]
    ];

    public function testGetViewStateFromHtmlInvalid(): void
    {
        $doc = new \DOMDocument();
        $doc->loadHTML('<html><body><div></div></body></html>');
        $this->assertEquals(Parser::getViewStateFromHtml($doc), null);
    }

    public function testGetViewStateFromHtmlValid(): void
    {
        $doc = new \DOMDocument();
        $doc->loadHTML('<html><body><div id="j_id__v_0:javax.faces.ViewState:1" value="viewstate"></div></body></html>');
        $this->assertEquals(Parser::getViewStateFromHtml($doc), 'viewstate');
    }

    public function testGetDataFromHtml(): void
    {
        $file = file_get_contents(__DIR__  . '/sample.html');
        $doc = new \DOMDocument();
        $doc->loadHTML($file);
        $data = Parser::getDataFromHtml($doc);

        $this->assertTrue(\is_array($data));
        $this->assertEquals($data, self::EXPECT_DATA);
    }

    public function testToEuros(): void
    {
        $this->assertEquals(Parser::toEuros(null), 0);
        $this->assertEquals(Parser::toEuros(1), 1);
        $this->assertEquals(Parser::toEuros('10 000 €'), 10000);
    }

    public function testToFloat(): void
    {
        $this->assertEquals(Parser::toFloat(null), 0);
        $this->assertEquals(Parser::toFloat(1.5), 1.5);
    }

    public function testToInteger(): void
    {
        $this->assertEquals(Parser::toInteger(null), 0);
        $this->assertEquals(Parser::toInteger(1), 1);
    }

    public function testGetImpot(): void
    {
        $this->assertEquals(Parser::getImpot('Non imposable'), null);
    }

}
