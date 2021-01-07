<?php namespace backend\tests;

use common\models\Leitor;
use common\models\User;

class CreateLeitorTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        //
        $user = new User();
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $leitor = new Leitor();

        $leitor->nome = 55;
        $this->assertFalse($leitor->validate('nome'));
        $leitor->nome = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($leitor->validate('nome'));
        $leitor->nome = 'André Machado';
        $this->assertTrue($leitor->validate('nome'));

        $leitor->codBarras = 45;
        $this->assertFalse($leitor->validate('codBarras'));
        $leitor->codBarras = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($leitor->validate('codBarras'));
        $leitor->codBarras = 'wer2dgdeg';
        $this->assertTrue($leitor->validate('codBarras'));

        $leitor->nif = 111111111111111111111111;
        $this->assertFalse($leitor->validate('nif'));
        $leitor->nif = 'sdgsadgsdfg';
        $this->assertFalse($leitor->validate('nif'));
        $leitor->nif = 269745017;
        $this->assertTrue($leitor->validate('nif'));

        $leitor->dataNasc = ' ';
        $this->assertFalse($leitor->validate('dataNasc'));
        $leitor->dataNasc = null;
        $this->assertFalse($leitor->validate('dataNasc'));
        $leitor->dataNasc = '2020-01-01';
        $this->assertTrue($leitor->validate('dataNasc'));


        $leitor->morada = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($leitor->validate('morada'));
        $leitor->morada = 27;
        $this->assertFalse($leitor->validate('morada'));
        $leitor->morada = 'Rua';
        $this->assertTrue($leitor->validate('morada'));

        $leitor->localidade = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($leitor->validate('localidade'));
        $leitor->localidade = 27;
        $this->assertFalse($leitor->validate('localidade'));
        $leitor->localidade = 'Peniche';
        $this->assertTrue($leitor->validate('localidade'));

        $leitor->codPostal = 'a';
        $this->assertFalse($leitor->validate('codPostal'));
        $leitor->codPostal = 0.1;
        $this->assertFalse($leitor->validate('codPostal'));
        $leitor->codPostal = 2520295;
        $this->assertTrue($leitor->validate('codPostal'));

        $leitor->telemovel = .05;
        $this->assertFalse($leitor->validate('telemovel'));
        $leitor->telemovel = 'teste';
        $this->assertFalse($leitor->validate('telemovel'));
        $leitor->telemovel = 915992258;
        $this->assertTrue($leitor->validate('telemovel'));

        $leitor->Biblioteca_id = 1;
        $leitor->TipoLeitor_id = 1;

        $leitor->user_id = 1;

        $leitor->save();
    }
}