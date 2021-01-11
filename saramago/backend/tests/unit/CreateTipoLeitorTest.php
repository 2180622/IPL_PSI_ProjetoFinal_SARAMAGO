<?php namespace backend\tests;

use common\models\Tipoleitor;
use common\models\User;

class CreateTipoLeitorTest extends \Codeception\Test\Unit
{

    protected $tester;
    protected $tipoLeitor;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->tipoLeitor = new Tipoleitor();

        $this->tipoLeitor->estatuto = "alunoalunoaluno";
        $this->tipoLeitor->estatuto = "";

        $this->tipoLeitor->tipo = "";

        $this->tipoLeitor->nItens = 5;

        $this->tipoLeitor->prazoDias = 3;

        $this->tipoLeitor->registoOpac = 0;

        $this->tipoLeitor->notas = "";

        $this->assertEquals();

        $this->tester->dontSeeRecord('common\models\Tipoleitor', ['estatuto' => 'alunoalunoaluno']);


    }
}