<?php

namespace SecavisWrapper\SecavisPHP\Tests\Model;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\Model\Avis;
use SecavisWrapper\SecavisPHP\Model\Declarant;
use SecavisWrapper\SecavisPHP\Model\FoyerFiscal;

class FoyerFiscalTest extends TestCase
{
    public function testSettersAndGetters(): void
    {
        $model = (new FoyerFiscal())
            ->setNumeroFiscal('test')
            ->setAdresse(['test'])
            ->addDeclarant(new Declarant())
            ->setAvis(new Avis());

        $this->assertEquals($model->getNumeroFiscal(), 'test');
        $this->assertEquals($model->getAdresse()[0], 'test');
        $this->assertTrue(\is_array($model->getDeclarants()));
        $this->assertTrue(\current($model->getDeclarants()) instanceof Declarant);
        $this->assertInstanceOf(Avis::class, $model->getAvis());
    }

}
