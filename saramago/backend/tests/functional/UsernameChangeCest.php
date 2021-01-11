<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class UsernameChangeCest
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
        $I->click('#conta');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/config/conta');

        $I->click('#modalButtonUsername');
        $I->amOnPage('/leitor/create/_form');
    }
}
