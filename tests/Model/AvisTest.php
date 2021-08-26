<?php

namespace SecavisWrapper\SecavisPHP\Tests\Model;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\Model\Avis;

class AvisTest extends TestCase
{
    public function testSettersAndGetters(): void
    {
        $model = (new Avis())
            ->setReference('test')
            ->setDateRecouvrement('test')
            ->setDateEtablissement('test')
            ->setParts(1)
            ->setSituationFamille('test')
            ->setPersonnesCharges(1)
            ->setRevenuBrut(1)
            ->setRevenuImposable(1)
            ->setRevenuFiscal(1)
            ->setMontantImpotNet(1)
            ->setMontantImpot(1);

        $this->assertEquals($model->getReference(), 'test');
        $this->assertEquals($model->getDateRecouvrement(), 'test');
        $this->assertEquals($model->getDateEtablissement(), 'test');
        $this->assertEquals($model->getParts(), 1);
        $this->assertEquals($model->getSituationFamille(), 'test');
        $this->assertEquals($model->getPersonnesCharges(), 1);
        $this->assertEquals($model->getRevenuBrut(), 1);
        $this->assertEquals($model->getRevenuImposable(), 1);
        $this->assertEquals($model->getRevenuFiscal(), 1);
        $this->assertEquals($model->getMontantImpotNet(), 1);
        $this->assertEquals($model->getMontantImpot(), 1);
    }

    public function testGetAnnee(): void
    {
        $model = new Avis();
        $this->assertEquals($model->getAnnee(), null);

        $model->setReference('1');
        $this->assertEquals($model->getAnnee(), null);

        $model->setReference('ab20');
        $this->assertEquals($model->getAnnee(), null);

        $model->setReference('20ab');
        $this->assertEquals($model->getAnnee(), '2020');
    }

}
