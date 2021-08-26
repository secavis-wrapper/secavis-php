<?php

namespace SecavisWrapper\SecavisPHP\Tests\Model;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\Model\Declarant;

class DeclarantTest extends TestCase
{
    public function testSettersAndGetters(): void
    {
        $model = (new Declarant())
            ->setNom('test')
            ->setNomNaissance('test')
            ->setPrenoms('test')
            ->setDateNaissance('test');

        $this->assertEquals($model->getNom(), 'test');
        $this->assertEquals($model->getNomNaissance(), 'test');
        $this->assertEquals($model->getPrenoms(), 'test');
        $this->assertEquals($model->getDateNaissance(), 'test');
    }

}
