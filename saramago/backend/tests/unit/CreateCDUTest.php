<?php namespace backend\tests;

use common\models\Cdu;

class CreateCDUTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $cdu = new Cdu();

        $cdu->codCdu = "42036";
        $this->assertTrue($cdu->validate('codCDU'));

        $cdu->designacao = 1;
        $this->assertFalse($cdu->validate('designacao'));
        $cdu->designacao = null;
        $this->assertFalse($cdu->validate('designacao'));
        $cdu->designacao = "Esta é a designação do Código Decimal Universal";
        $this->assertTrue($cdu->validate('designacao'));

        $this->tester->haveRecord('common\models\Cdu', [
            'codCdu' => '36420',
            'designacao' => 'Designacao do CDU'
        ]);

        $this->tester->seeRecord('common\models\Cdu', ['codCdu' => '36420']);
    }
}