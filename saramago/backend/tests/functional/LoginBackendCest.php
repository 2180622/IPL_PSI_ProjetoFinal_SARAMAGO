<?php

namespace backend\tests\functional;

use common\fixtures\UserFixture;
use backend\tests\FunctionalTester;

class LoginBackendCest
{
    /**
     * @var \backend\tests\FunctionalTester
     */

    protected $tester;

    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        /*return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];*/
    }

    protected function formParams ($login, $password)
    {
        return [
            'LoginForm[username]'=> $login,
            'LoginForm[password]'=> $password,
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    // tests
    public function loginUser(FunctionalTester $I){

        $I->seeElement('#login-form');
        $I->submitForm('#login-form', $this->formParams('admin','adminsaramago'));

        $I->dontSeeLink('Login');
        $I->dontSeeElement('#login-form');
        //ver a conta que está iniciada

        $I->see('admin', '.dropdown-toggle');
    }

    public function loginFailPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'ov7to87tvo87'));
        $I->seeValidationError('Username ou password incorreta.');
    }

    public function loginFailUser(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('iugkhfy', 'ov7to87tvo87'));
        $I->seeValidationError('Username ou password incorreta.');
    }

}