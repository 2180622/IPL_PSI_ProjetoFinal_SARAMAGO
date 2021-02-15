<?php
namespace backend\tests\functional;
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

        /*$I->click('#w0');
        $I->amOnPage('/leitor');*/
        $I->click('#modalButtonAlunoCreate');
    }

    // tests
    public function CreateLeitor(FunctionalTester $I)
    {
        $I->amOnPage('/leitor/create/_form');

        $I->fillField('#leitorform-nome', 'Andre');
        $I->fillField('#leitorform-username', 'teste');
        $I->fillField('#leitorform-nif', 269745013);
        $I->fillField('#leitorform-docid', 303159959);
        $I->fillField('#leitorform-datanasc', '06/01/2021');
        $I->fillField('#leitorform-morada', 'Rua');
        $I->fillField('#leitorform-localidade', 'Leiria');
        $I->fillField('#leitorform-codpostal', 5632489);
        $I->fillField('#leitorform-telemovel', 915992258);
        $I->fillField('#leitorform-email', 'andre@gmail.com');
        $I->selectOption('#leitorform-biblioteca_id', 'Biblioteca Alberto Caeiro');
        $I->selectOption('#leitorform-tipoleitor_id', 'Aluno de TeSP');

        $I->click('#guardar');

        $I->see('O Leitor foi adicionado com sucesso.');
    }
}
