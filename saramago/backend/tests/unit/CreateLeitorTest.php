<?php namespace backend\tests;

use common\models\Leitor;
use common\models\User;

class CreateLeitorTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        //
        $user = new User();
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $user = new User();

        $user->username = 'andremach';
        $this->assertTrue($user->validate('username'));

        $user->username = 262;
        $this->assertFalse($user->validate('username'));

        $user->username = null;
        $this->assertFalse($user->validate('username'));

        $user->username = 'a56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfa56sd4f65as4dfaksjdfhkashdfkjashdfjk';
        $this->assertFalse($user->validate('username'));
    }
}