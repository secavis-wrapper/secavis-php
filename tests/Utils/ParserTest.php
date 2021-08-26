<?php

namespace SecavisWrapper\SecavisPHP\Tests\Utils;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\Utils\Parser;

class ParserTest extends TestCase
{
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
