<?php
namespace backend\tests\acceptance;
use backend\tests\AcceptanceTester;

class UsernameChangeCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/site/login');
    }

    public function UsernameChangeTest(AcceptanceTester $I)
    {
        $I->wait(2);
        $I->fillField('Username', 'admin');
        $I->fillField('Password', 'adminsaramago');
        $I->click('login-button');
        $I->wait(2);
        $I->amOnPage('/');
        $I->wait(2);
        $I->seeElement('#config');
        $I->click('#config');
        $I->amOnPage('/config');
        $I->wait(2);
        $I->click('/html/body/div[1]/div/div/div[2]/div[1]/a[1]/div/div/h4');
        $I->wait(2);
        $I->amOnPage('/config/conta');
        $I->click('#modalButtonUsername');
        $I->wait(2);
        $I->fillField('//*[@id="changeusernameform-username"]', 'adminbatat');
        $I->fillField('//*[@id="changeusernameform-retypeusername"]', 'adminbatat');
        $I->click('//*[@id="username-form"]/div[4]/button');
        $I->wait(2);
        $I->seeElement('//*[@id="w3-success-0"]');
    }
}
