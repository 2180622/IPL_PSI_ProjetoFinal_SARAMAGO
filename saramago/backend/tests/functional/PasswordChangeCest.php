<?php
namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class PasswordChangeCest
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

    public function PasswordChangeTest(FunctionalTester $I)
    {
        $I->amOnPage('/config/conta');
        $I->see('Conta');
        $I->click('//*[@id="modalButtonPassword"]');
        $I->amOnPage('/config/conta-password');
        $I->fillField('//*[@id="changepasswordform-oldpassword"]', 'adminsaramago');
        $I->fillField('//*[@id="changepasswordform-newpassword"]', 'adminbatat');
        $I->fillField('//*[@id="changepasswordform-retypepassword"]', 'adminbatat');
        $I->click('//*[@id="password-form"]/div[4]/button');
        //$I->amOnPage('/config/conta');
        $I->see('A password foi alterada com sucesso!');
    }
}

