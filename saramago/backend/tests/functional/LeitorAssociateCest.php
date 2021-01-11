<?php namespace backend\tests\functional;
use backend\models\LeitorForm;
use backend\tests\FunctionalTester;
use common\fixtures\LeitorFixture;
use common\models\Leitor;
use common\models\Tipoleitor;
use common\models\User;

class LeitorAssociateCest
{

    public function _fixtures(){
        return [
            'leitor' => [
                'class' => LeitorFixture::className(),
                'dataFile' => codecept_data_dir().'leitor_create.php'
            ]
        ];
    }
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('Username', 'admin');
        $I->fillField('Password', 'adminsaramago');
        $I->click('login-button');
        $I->amOnPage('/');
        $I->click('#config');
        $I->amOnPage('/config');
    }

    // tests
    public function AssociateLeitor(FunctionalTester $I)
    {
        $I->click('#equipa');
        $I->amOnPage('/config/equipa');
        $I->click('#modalButtonAssociate');
        $I->amOnPage('/config/equipa-associate');

        $I->selectOption('#equipacreateform-leitor_id', 'Andre Machado');
        $I->selectOption('#equipacreateform-rolenova', 'Operador Chefe');

        $I->click('#guardar');
        $I->see('O Operador foi modificado.');
    }
}