<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class BibliotecaCreateCest
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
        $I->click('#bibliotecas');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/config/bibliotecas');

        $I->click('#modalButtonCreate');
        $I->amOnPage('/leitor/create/_form');
    }
}
