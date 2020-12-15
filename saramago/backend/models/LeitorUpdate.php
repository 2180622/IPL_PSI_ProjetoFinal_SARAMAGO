<?php


namespace app\models;


use common\models\Aluno;
use common\models\Funcionario;
use common\models\Leitor;
use common\models\User;
use DateTime;
use DeepCopy\f001\A;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class LeitorUpdate extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $mail2;
    public $nome;
    public $departamento;
    public $numero;
    public $nif;
    public $docId;
    public $dataNasc;
    public $morada;
    public $localidade;
    public $codPostal;
    public $telemovel;
    public $telefone;
    public $notaInterna;
    public $Biblioteca_id;
    public $TipoLeitor_id;
    public $user_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Nome de utilizador em uso.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Endereço de email em uso.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['mail2', 'trim'],
            ['mail2', 'email'],
            ['mail2', 'string', 'max' => 255],
            ['mail2', 'unique', 'targetClass' => '\common\models\Leitor', 'message' => 'Endereço de email em uso.'],

            ['nome', 'trim'],
            ['nome', 'required'],
            ['nome', 'string', 'min' => 2, 'max' => 255],

            ['departamento', 'trim'],
            ['departamento', 'string', 'max' => 255],

            ['numero', 'trim'],
            ['numero', 'integer'],

            ['nif', 'trim'],
            ['nif', 'required'],
            ['nif', 'string', 'min' => 9, 'max' => 9],

            ['docId', 'trim'],
            ['docId', 'required'],
            ['docId', 'unique', 'targetClass' => '\common\models\Leitor', 'message' => 'Número de documento em uso.'],
            ['docId', 'string', 'min' => 9, 'max' => 9],

            ['dataNasc', 'trim'],
            ['dataNasc', 'required'],
            ['dataNasc', 'datetime', 'format' => 'dd/MM/yyyy', 'message' => 'Formato de data inválido.'],
            ['dataNasc', 'string', 'min' => 1, 'max' => 50],

            ['morada', 'trim'],
            ['morada', 'required'],
            ['morada', 'string', 'min' => 1, 'max' => 255],

            ['localidade', 'trim'],
            ['localidade', 'required'],
            ['localidade', 'string', 'min' => 1, 'max' => 45],

            ['codPostal', 'trim'],
            ['codPostal', 'required'],
            ['codPostal', 'string', 'min' => 6, 'max' => 10],

            ['telemovel', 'trim'],
            ['telemovel', 'required'],
            ['telemovel', 'string', 'min' => 9, 'max' => 9],

            ['telefone', 'trim'],
            ['telefone', 'string', 'min' => 9, 'max' => 9],

            ['notaInterna', 'trim'],
            ['notaInterna', 'string', 'min' => 1, 'max' => 45],

            ['Biblioteca_id', 'trim'],
            ['Biblioteca_id', 'integer'],

            ['TipoLeitor_id', 'trim'],
            ['TipoLeitor_id', 'integer'],

            ['user_id', 'trim'],
            ['user_id', 'integer'],
        ];
    }

    public function __construct($id)
    {
        $leitor = $this->findModel($id);
        $user = User::findOne($leitor->user_id);
        $funcionario = $this->findFuncionario($id);
        $aluno = $this->findAluno($id);

        $this->id = $leitor->id;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->mail2 = $leitor->mail2;
        $this->nome = $leitor->nome;
        $this->nif = $leitor->nif;
        $this->docId = $leitor->docId;
        $this->dataNasc = $leitor->dataNasc;
        $this->morada = $leitor->morada;
        $this->localidade = $leitor->localidade;
        $this->codPostal = $leitor->codPostal;
        $this->telemovel = $leitor->telemovel;
        $this->telefone = $leitor->telefone;
        $this->notaInterna = $leitor->notaInterna;
        $this->Biblioteca_id = $leitor->Biblioteca_id;
        $this->TipoLeitor_id = $leitor->TipoLeitor_id;

        // the following three lines were added:
        $auth = \Yii::$app->authManager;
    }

    public function update()
    {
        $auth = Yii::$app->authManager;
        //Encontra os objetos ja criados na base de dados
        $leitor = Leitor::findOne($this->id);
        $user = User::findOne($leitor->user_id);
        $funcionario = $this->findFuncionario($leitor->id);
        $aluno = $this->findAluno($leitor->id);


        // SE O LEITOR FOR ALUNO
        if ($leitor->tipoLeitor->tipo == "aluno") {

            // após verificar qual o seu tipo de leitor, são introduzidos os novos parametros de acordo com o update
            $userUpdated = $this->getUserFormFields($user);
            $leitorUpdated = $this->getLeitorFormFields($leitor);

            // caso nao haja alteração no tipo e ele continue ALUNO
            if ($leitorUpdated->tipoLeitor->tipo == "aluno") {
                // atualiza o aluno
                $aluno->numero = $this->numero;
                $userUpdated->save();
                $leitorUpdated->save();
                $aluno->Leitor_id = $leitor->id;
                $aluno->save();

            } elseif ($leitorUpdated->tipoLeitor->tipo == "docente") {

                // cria novo funcionario e elimina o aluno
                $funcionario = New Funcionario();
                $funcionario->departamento = $this->departamento;
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->Leitor_id = $leitorUpdated->id;
                $funcionario->save();
                $aluno->delete();

                $leitorDocenteRole = $auth->getRole('leitorDocente');
                $auth->assign($leitorDocenteRole, $leitorUpdated->user_id);

            } elseif ($leitorUpdated->tipoLeitor->tipo == "funcionario") {

                // cria novo funcionario e elimina o aluno
                $funcionario = New Funcionario();
                $funcionario->departamento = $this->departamento;
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->Leitor_id = $leitorUpdated->id;
                $funcionario->save();
                $aluno->delete();

                $leitorFuncionarioRole = $auth->getRole('leitorFuncionario');
                $auth->assign($leitorFuncionarioRole, $leitorUpdated->user_id);

            } elseif ($leitorUpdated->tipoLeitor->tipo == "externo") {

                // passa a leitor externo e elimina o aluno
                $userUpdated->save();
                $leitorUpdated->save();
                $aluno->delete();

                $leitorExternoRole = $auth->getRole('leitorExterno');
                $auth->assign($leitorExternoRole, $leitorUpdated->user_id);
            }
        }


        // SE O LEITOR FOR DOCENTE
        if ($leitor->tipoLeitor->tipo == "docente") {

            // após verificar qual o seu tipo de leitor, são introduzidos os novos parametros de acordo com o update
            $userUpdated = $this->getUserFormFields($user);
            $leitorUpdated = $this->getLeitorFormFields($leitor);

            // caso nao haja alteração no tipo e ele continue DOCENTE
            if ($leitorUpdated->tipoLeitor->tipo == "aluno") {

                // cria novo aluno e elimina o funcionario
                $aluno = new Aluno();

                $aluno->numero = $this->numero;
                $userUpdated->save();
                $leitorUpdated->save();
                $aluno->Leitor_id = $leitorUpdated->id;
                $aluno->save();
                $funcionario->delete();

                $leitorAlunoRole = $auth->getRole('leitorAluno');
                $auth->assign($leitorAlunoRole, $leitorUpdated->user_id);

            }elseif($leitorUpdated->tipoLeitor->tipo == "docente") {

                // atualiza o docente
                $funcionario->departamento = $this->departamento;
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->Leitor_id = $leitorUpdated->id;
                $funcionario->save();

            } elseif ($leitorUpdated->tipoLeitor->tipo == "funcionario") {

                // atualiza o funcionario e atribui-lhe a nova role
                $funcionario->departamento = $this->departamento;
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->Leitor_id = $leitorUpdated->id;
                $funcionario->save();

                $leitorFuncionarioRole = $auth->getRole('leitorFuncionario');
                $auth->assign($leitorFuncionarioRole, $leitorUpdated->user_id);

            } elseif ($leitorUpdated->tipoLeitor->tipo == "externo") {

                //elimina o funcionario e atualiza a role para externo
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->delete();

                $leitorExternoRole = $auth->getRole('leitorExterno');
                $auth->assign($leitorExternoRole, $leitorUpdated->user_id);
            }

        }


        // SE O LEITOR FOR FUNCIONÁRIO
        if($leitor->tipoLeitor->tipo == "funcionario") {

            // após verificar qual o seu tipo de leitor, são introduzidos os novos parametros de acordo com o update
            $userUpdated = $this->getUserFormFields($user);
            $leitorUpdated = $this->getLeitorFormFields($leitor);

            if ($leitorUpdated->tipoLeitor->tipo == "aluno") {

                // cria novo aluno e elimina o funcionario
                $aluno = new Aluno();
                $aluno->numero = $this->numero;
                $userUpdated->save();
                $leitorUpdated->save();
                $aluno->Leitor_id = $leitorUpdated->id;
                $aluno->save();
                $funcionario->delete();

                $leitorAlunoRole = $auth->getRole('leitorAluno');
                $auth->assign($leitorAlunoRole, $leitorUpdated->user_id);

            } elseif ($leitorUpdated->tipoLeitor->tipo == "docente") {

                // atualiza o funcionario e atualiza a role
                $funcionario->departamento = $this->departamento;
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->Leitor_id = $leitorUpdated->id;
                $funcionario->save();

                $leitorDocenteRole = $auth->getRole('leitorDocente');
                $auth->assign($leitorDocenteRole, $leitorUpdated->user_id);

            } elseif ($leitorUpdated->tipoLeitor->tipo == "funcionario") {

                // atualiza o funcionario
                $funcionario->departamento = $this->departamento;
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->Leitor_id = $leitorUpdated->id;
                $funcionario->save();

            } elseif ($leitorUpdated->tipoLeitor->tipo == "externo") {

                // elimina o funcionario e altera a role para externo
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->delete();

                $leitorExternoRole = $auth->getRole('leitorExterno');
                $auth->assign($leitorExternoRole, $leitorUpdated->user_id);
            }
        }

        // SE O LEITOR FOR EXTERNO
        if($leitor->tipoLeitor->tipo == "externo"){

            // após verificar qual o seu tipo de leitor, são introduzidos os novos parametros de acordo com o update
            $userUpdated = $this->getUserFormFields($user);
            $leitorUpdated = $this->getLeitorFormFields($leitor);

            if($leitorUpdated->tipoLeitor->tipo == "aluno") {

                // cria novo aluno
                $aluno = new Aluno();
                $aluno->numero = $this->numero;
                $userUpdated->save();
                $leitorUpdated->save();
                $aluno->Leitor_id = $leitorUpdated->id;
                $aluno->save();

                $leitorAlunoRole = $auth->getRole('leitorAluno');
                $auth->assign($leitorAlunoRole, $leitorUpdated->user_id);

            } elseif ($leitorUpdated->tipoLeitor->tipo == "docente") {

                // cria novo funcionario e atribui a role
                $funcionario = New Funcionario();
                $funcionario->departamento = $this->departamento;
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->Leitor_id = $leitorUpdated->id;
                $funcionario->save();

                $leitorDocenteRole = $auth->getRole('leitorDocente');
                $auth->assign($leitorDocenteRole, $leitorUpdated->user_id);

            } elseif ($leitorUpdated->tipoLeitor->tipo == "funcionario") {

                // cria novo funcionario e atribui a role
                $funcionario = New Funcionario();
                $funcionario->departamento = $this->departamento;
                $userUpdated->save();
                $leitorUpdated->save();
                $funcionario->Leitor_id = $leitorUpdated->id;
                $funcionario->save();

                $leitorFuncionarioRole = $auth->getRole('leitorFuncionario');
                $auth->assign($leitorFuncionarioRole, $leitorUpdated->user_id);

            } elseif ($leitorUpdated->tipoLeitor->tipo == "externo") {
                // atualiza o leitor externo
                $userUpdated->save();
                $leitorUpdated->save();
            }
        }

        return $leitor && $user;
    }

    public function findFuncionario($id){
        $funcionarios = Funcionario::find()->all();
        $leitor = Leitor::findOne($id);

        foreach ($funcionarios as $funcionario) {
            if ($funcionario->Leitor_id == $leitor->id) {
                return $funcionario;
            }else{
                return false;
            }
        }
    }

    public function findAluno($id){
        $alunos = Aluno::find()->all();
        $leitor = Leitor::findOne($id);

        foreach ($alunos as $aluno) {
            if ($aluno->Leitor_id == $leitor->id) {
                return $aluno;
            }else{
                return false;
            }
        }
    }

    public function getLeitorFormFields($leitor){
        $leitor->mail2 = $this->mail2;
        $leitor->nome = $this->nome;
        $leitor->nif = $this->nif;
        $leitor->docId = $this->docId;
        $myDateTime = DateTime::createFromFormat('d/m/Y', $this->dataNasc);
        $newDateString = $myDateTime->format('Y/m/d');
        $leitor->dataNasc = $newDateString;
        $leitor->morada = $this->morada;
        $leitor->localidade = $this->localidade;
        $leitor->codPostal = $this->codPostal;
        $leitor->telemovel = $this->telemovel;
        $leitor->telefone = $this->telefone;
        $leitor->notaInterna = $this->notaInterna;
        $leitor->Biblioteca_id = $this->Biblioteca_id;
        $leitor->TipoLeitor_id = $this->TipoLeitor_id;

        return $leitor;
    }
    public function getUserFormFields($user){
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->status = 10;

        return $user;
    }

    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function findModel($id)
    {
        if (($model = Leitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}