<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class LeitorCreateCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('Username', 'admin');
        $I->fillField('Password', 'adminsaramago');
        $I->click('login-button');

        $I->click('#leitores');
        $I->amOnPage('/leitor');

        $I->click('#modalButtonCreate');

        $I->amOnPage('/leitor/create/_form');

        $I->fillField('#leitorform-nome', 'André Filipe Andrade Machado');
        $I->fillField('#leitorform-username', 'andremach');
        $I->fillField('#leitorform-password', 'andremach');
        $I->fillField('#leitorform-nif', 269745017);
        $I->fillField('#leitorform-docid', '303159952');
        $I->fillField('#leitorform-datanasc', 2000-10-11);
        $I->fillField('#leitorform-morada', 'Rua Arquiteto Paulino Montez');
        $I->fillField('#leitorform-localidade', 'Peniche');
        $I->fillField('#leitorform-codpostal', 2520295);
        $I->fillField('#leitorform-telemovel', 915992258);
        $I->fillField('#leitorform-telefone', null);
        $I->fillField('#leitorform-email', 'andre.machado@gmail.com');
        $I->fillField('#leitorform-mail2', null);
        $I->fillField('#leitorform-notainterna', null);
        $I->selectOption('#leitorform-biblioteca_id', 'Biblioteca Alberto Caeiro');
        $I->selectOption('#leitorform-tipoleitor_id', 'Funcionário');

        $I->click('#guardar');
    }
}
