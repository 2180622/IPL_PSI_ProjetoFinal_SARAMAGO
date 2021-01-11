<?php namespace backend\tests;

use common\models\Tipoexemplar;

class CreateTipoExemplarTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    private $tipoexemplar;

    public function testCreateTipoExemplarFeature()
    {
        $this->tipoexemplar = new Tipoexemplar();

        $this->tipoexemplar->designacao = 33;
        $this->assertFalse($this->tipoexemplar->validate('designacao'));
        $this->tipoexemplar->designacao = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->tipoexemplar->validate('designacao'));
        $this->tipoexemplar->designacao = 'Livro 3D';
        $this->assertTrue($this->tipoexemplar->validate('designacao'));

        $this->tipoexemplar->tipo = 5;
        $this->assertFalse($this->tipoexemplar->validate('tipo'));
        $this->tipoexemplar->tipo = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->tipoexemplar->validate('tipo'));
        $this->tipoexemplar->tipo = 'materialAv';
        $this->assertTrue($this->tipoexemplar->validate('tipo'));

        $this->tipoexemplar->save();

        $this->tester->seeRecord('common\models\Tipoexemplar', ['designacao' => 'Livro 3D']);

    }
}