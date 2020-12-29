<?php namespace backend\tests\functional;
use backend\models\LeitorForm;
use backend\tests\FunctionalTester;

class LeitorAssociateCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('Username', 'admin');
        $I->fillField('Password', 'adminsaramago');
        $I->click('login-button');

        $I->amOnPage('/');
        $I->click('#config');
        $I->amOnPage('/config');
        $I->click('#equipa');

    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/config/equipa');
        $I->click('#modalButtonAssociate');

        $I->see('', '.modal-content');

        $I->selectOption('#equipacreateform-leitor_id', 'André Machado');
        $I->selectOption('#equipacreateform-rolenova', 'Operador Chefe');

        $I->click('#guardar');
    }
}
