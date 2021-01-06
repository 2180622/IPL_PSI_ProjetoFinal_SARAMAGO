<?php


namespace frontend\tests\acceptance;
use common\fixtures\UserFixture as UserFixture;
use frontend\tests\AcceptanceTester;

class SigninCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
        ];
    }
    public function _before(AcceptanceTester $I)
    {
    }

    public function tryToLogin(AcceptanceTester $I)
    {
        $I->wait(2);
        $I->amOnPage('site/login');
        $I->wait(2);
        $I->fillField('Username', 'admin');
        $I->fillField('Password','adminsaramago');
        $I->wait(2);
        $I->click('login-button');
        $I->wait(2);
        $I->see('Logout (admin)');
        $I->wait(5);
    }
}