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

    // tests
    public function loginUser(FunctionalTester $I){
        //$I->amOnRoute('site/login');
        $I->amOnPage('site/login');
        $I->seeElement('#login-form');
        $I->submitForm('#login-form', $this->formParams('admin','adminsaramago'));

        //ver a conta que está iniciada
        $I->see('admin', '.dropdown-toggle');
    }

}