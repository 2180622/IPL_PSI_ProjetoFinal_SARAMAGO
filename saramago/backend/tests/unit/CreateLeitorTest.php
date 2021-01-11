<?php namespace backend\tests;

use common\models\Leitor;
use common\models\User;

class CreateLeitorTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    private $leitor;

    public function testSomeFeature()
    {
        $this->leitor = new Leitor();

        $this->leitor->nome = 55;
        $this->assertFalse($this->leitor->validate('nome'));
        $this->leitor->nome = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->leitor->validate('nome'));
        $this->leitor->nome = 'André Machado';
        $this->assertTrue($this->leitor->validate('nome'));

        $this->leitor->codBarras = 45;
        $this->assertFalse($this->leitor->validate('codBarras'));
        $this->leitor->codBarras = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->leitor->validate('codBarras'));
        $this->leitor->codBarras = 'wer2dgdeg';
        $this->assertTrue($this->leitor->validate('codBarras'));

        $this->leitor->nif = 111111111111111111111111;
        $this->assertFalse($this->leitor->validate('nif'));
        $this->leitor->nif = 'sdgsadgsdfg';
        $this->assertFalse($this->leitor->validate('nif'));
        $this->leitor->nif = 269745015;
        $this->assertTrue($this->leitor->validate('nif'));

        $this->leitor->dataNasc = ' ';
        $this->assertFalse($this->leitor->validate('dataNasc'));
        $this->leitor->dataNasc = null;
        $this->assertFalse($this->leitor->validate('dataNasc'));
        $this->leitor->dataNasc = '2020-01-01';
        $this->assertTrue($this->leitor->validate('dataNasc'));


        $this->leitor->morada = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->leitor->validate('morada'));
        $this->leitor->morada = 27;
        $this->assertFalse($this->leitor->validate('morada'));
        $this->leitor->morada = 'Rua';
        $this->assertTrue($this->leitor->validate('morada'));

        $this->leitor->localidade = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->leitor->validate('localidade'));
        $this->leitor->localidade = 27;
        $this->assertFalse($this->leitor->validate('localidade'));
        $this->leitor->localidade = 'Peniche';
        $this->assertTrue($this->leitor->validate('localidade'));

        $this->leitor->codPostal = 'a';
        $this->assertFalse($this->leitor->validate('codPostal'));
        $this->leitor->codPostal = 0.1;
        $this->assertFalse($this->leitor->validate('codPostal'));
        $this->leitor->codPostal = 2520295;
        $this->assertTrue($this->leitor->validate('codPostal'));

        $this->leitor->telemovel = .05;
        $this->assertFalse($this->leitor->validate('telemovel'));
        $this->leitor->telemovel = 'teste';
        $this->assertFalse($this->leitor->validate('telemovel'));
        $this->leitor->telemovel = 915992258;
        $this->assertTrue($this->leitor->validate('telemovel'));

        $this->leitor->Biblioteca_id = 1;
        $this->leitor->TipoLeitor_id = 1;
        $this->leitor->user_id = 2;

        $this->leitor->save();

        $this->tester->seeRecord('common\models\Leitor', ['nif' => 269745015]);

    }
}