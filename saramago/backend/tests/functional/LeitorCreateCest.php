<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class LeitorCreateCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('Username', 'admin');
        $I->fillField('Password', 'adminsaramago');
        $I->click('login-button');

        $I->click('#leitores');
        $I->amOnPage('/leitor');

        $I->click('#modalButtonCreate');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/config/bibliotecas/create/_form');

        $I->fillField('#biblioteca-codbiblioteca', 'BJS');
        $I->fillField('#biblioteca-nome', 'Biblioteca José Saramgo');
        $I->fillField('#biblioteca-morada', 'Rua da Biblioteca');
        $I->fillField('#biblioteca-localidade', 'Leiria');
        $I->fillField('#biblioteca-codPostal', 2400413);
        $I->selectOption('#biblioteca-levantamento', 'Sim');
        $I->fillField('#biblioteca-notasopac', 'Uma nota da biblioteca');

        $I->click('#guardar');
    }
}
