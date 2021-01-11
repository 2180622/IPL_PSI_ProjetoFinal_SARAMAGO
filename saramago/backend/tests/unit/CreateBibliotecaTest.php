<?php namespace backend\tests;

use common\models\Biblioteca;

class CreateBibliotecaTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    private $biblioteca;

    public function testCreateBibliotecaFeature()
    {
        $this->biblioteca = new Biblioteca();

        $this->biblioteca->codBiblioteca = 55;
        $this->assertFalse($this->biblioteca->validate('codBiblioteca'));
        $this->biblioteca->codBiblioteca = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->biblioteca->validate('codBiblioteca'));
        $this->biblioteca->codBiblioteca = '44444';
        $this->assertTrue($this->biblioteca->validate('codBiblioteca'));

        $this->biblioteca->nome = 45;
        $this->assertFalse($this->biblioteca->validate('nome'));
        $this->biblioteca->nome = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->biblioteca->validate('nome'));
        $this->biblioteca->nome = 'wer2dgdeg';
        $this->assertTrue($this->biblioteca->validate('nome'));

        $this->biblioteca->notasOpac = 111111111111111111111111;
        $this->assertFalse($this->biblioteca->validate('notasOpac'));
        $this->biblioteca->notasOpac = "awwwwwwwwwwwwwwwwwyea";
        $this->assertTrue($this->biblioteca->validate('notasOpac'));

        $this->biblioteca->morada = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->biblioteca->validate('morada'));
        $this->biblioteca->morada = 21;
        $this->assertFalse($this->biblioteca->validate('morada'));
        $this->biblioteca->morada = 'Rua';
        $this->assertTrue($this->biblioteca->validate('morada'));

        $this->biblioteca->localidade = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
        $this->assertFalse($this->biblioteca->validate('localidade'));
        $this->biblioteca->localidade = 47;
        $this->assertFalse($this->biblioteca->validate('localidade'));
        $this->biblioteca->localidade = 'Peniche';
        $this->assertTrue($this->biblioteca->validate('localidade'));

        $this->biblioteca->codPostal = 'a';
        $this->assertFalse($this->biblioteca->validate('codPostal'));
        $this->biblioteca->codPostal = 0.1;
        $this->assertFalse($this->biblioteca->validate('codPostal'));
        $this->biblioteca->codPostal = 2520295;
        $this->assertTrue($this->biblioteca->validate('codPostal'));

        $this->biblioteca->levantamento = .05;
        $this->assertFalse($this->biblioteca->validate('levantamento'));
        $this->biblioteca->levantamento = 'teste';
        $this->assertFalse($this->biblioteca->validate('levantamento'));
        $this->biblioteca->levantamento = 1;
        $this->assertTrue($this->biblioteca->validate('levantamento'));

        $this->biblioteca->save();

        $this->tester->seeRecord('common\models\Biblioteca', ['notasOpac' => "awwwwwwwwwwwwwwwwwyea"]);

    }
}