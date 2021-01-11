<?php namespace backend\tests;

use common\models\Leitor;
use common\models\Tipoleitor;
use common\models\User;

class CreateLeitorTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    public function testSomeFeature()
    {

        $leitor = new Leitor();
        $user = new User();
        $tipoLeitor = new Tipoleitor();

        $tipoLeitor->estatuto = 0;
        $this->assertFalse($tipoLeitor->validate('estatuto'));
        $tipoLeitor->estatuto = "aluno de Mestrado";
        $this->assertTrue($tipoLeitor->validate('estatuto'));


        $tipoLeitor->tipo = null;
        $this->assertFalse($tipoLeitor->validate('tipo'));
        $tipoLeitor->tipo = "aluno";
        $this->assertTrue($tipoLeitor->validate('tipo'));

        $tipoLeitor->nItens = "falhar";
        $this->assertFalse($tipoLeitor->validate('nItens'));
        $tipoLeitor->nItens = 5;
        $this->assertTrue($tipoLeitor->validate('nItens'));

        $tipoLeitor->prazoDias = "sem prazo";
        $this->assertFalse($tipoLeitor->validate('prazoDias'));
        $tipoLeitor->prazoDias = 10;
        $this->assertTrue($tipoLeitor->validate('prazoDias'));

        $tipoLeitor->registoOpac = 't';
        $this->assertFalse($tipoLeitor->validate('registoOpac'));
        $tipoLeitor->registoOpac = 1;
        $this->assertTrue($tipoLeitor->validate('registoOpac'));


        $user->username = 'andre';
        $this->assertTrue($user->validate('username'));

        $user->generateAuthKey();
        $user->setPassword('password');

        $user->email = 0;
        $this->assertFalse($user->validate('email'));
        $user->email = 'teste@gmail.com';
        $this->assertTrue($user->validate('email'));

        $tipoLeitor->save();
        $user->save();

        $this->tester->haveRecord('common\models\Leitor',[
            'nome' => 'Andre Machado',
            'codBarras' => 'wer2dgdeg',
            'nif' => 269745015,
            'dataNasc' =>'2020-01-01',
            'morada' => 'rua',
            'localidade' => 'leiria',
            'codPostal' => 2400413,
            'telemovel' => 915992252,
            'Biblioteca_id' => 1,
            'TipoLeitor_id' => $tipoLeitor->id,
            'user_id' => $user->id
        ]);

        $this->tester->seeRecord('common\models\Leitor', ['telemovel' => 915992252]);

    }
}