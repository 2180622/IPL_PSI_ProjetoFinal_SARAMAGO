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

        $this->tipoLeitor->estatuto = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($this->tipoLeitor->validate('estatuto'));
        $this->tipoLeitor->estatuto = null;
        $this->assertFalse($this->tipoLeitor->validate('estatuto'));
        $this->tipoLeitor->estatuto = 0;
        $this->assertFalse($this->tipoLeitor->validate('estatuto'));
        $this->tipoLeitor->estatuto = "Aluno de TeSP";
        $this->assertTrue($this->tipoLeitor->validate('estatuto'));

        $this->tipoLeitor->tipo = 0;
        $this->assertFalse($this->tipoLeitor->validate('tipo'));
        $this->tipoLeitor->tipo = "aluno";
        $this->asserttrue($this->tipoLeitor->validate('tipo'));

        $this->tipoLeitor->nItens = 5;
        $this->asserttrue($this->tipoLeitor->validate('nItens'));

        $this->tipoLeitor->prazoDias = 10;
        $this->asserttrue($this->tipoLeitor->validate('prazoDias'));

        $this->tipoLeitor->registoOpac = 1;
        $this->asserttrue($this->tipoLeitor->validate('registoOpac'));

        $this->tipoLeitor->notas = "Uma Nota";
        $this->asserttrue($this->tipoLeitor->validate('notas'));

        $this->tipoLeitor->save();

        $this->assertEquals('aluno - Aluno de TeSP', $this->tipoLeitor->tipo.' - '.$this->tipoLeitor->estatuto);

        $this->tester->seeRecord('common\models\TipoLeitor', ['estatuto' => 'Aluno de TeSP', 'tipo' => 'aluno', 'nItens' => 5, 'prazoDias' => 10, 'registoOpac' =>  1, 'notas' => 'Uma Nota']);
    }
}