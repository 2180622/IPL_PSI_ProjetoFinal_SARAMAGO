<?php
namespace backend\models;

use common\models\Aluno;
use common\models\Funcionario;
use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Leitor;
use common\models\Tipoleitor;
use DateTime;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

/**
 * LeitorCreate form
 */
class LeitorForm extends Leitor
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
    public $Curso_id;

    const ALUNO = 'aluno';
    const DOCENTE = 'docente';
    const EXTERNO = 'externo';

    public function scenarios()
    {
        return [
        self::ALUNO => [

            'id','username','email', 'mail2', 'nome', 'nif', 'dataNasc', 'docId', 'morada', 'localidade', 'codPostal', 'telemovel', 'telefone', 'notaInterna', 'Biblioteca_id','TipoLeitor_id', 'numero', 'Curso_id',

        ],
        self::DOCENTE => [

            'id','username','email', 'mail2', 'nome', 'nif', 'dataNasc', 'docId', 'morada', 'localidade', 'codPostal', 'telemovel', 'telefone', 'notaInterna', 'Biblioteca_id','TipoLeitor_id', 'departamento',

        ],
        self::EXTERNO => [

            'id','username','email', 'mail2', 'nome', 'nif', 'dataNasc', 'docId', 'morada', 'localidade', 'codPostal', 'telemovel', 'telefone', 'notaInterna', 'Biblioteca_id','TipoLeitor_id',

        ],
    ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Nome de utilizador em uso.'],
            ['username', 'string', 'min' => 5, 'max' => 10],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Endereço de email em uso.'],

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
            ['numero', 'default', 'value'=> 0],

            ['nif', 'required'],
            ['nif', 'string', 'min' => 9, 'max' => 9],
            ['nif', 'unique', 'targetClass' => '\common\models\Leitor', 'message' => 'NIF já se encontra em uso.'],
            ['nif', 'match', 'pattern' => '/^[0-9]+$/', 'message' => 'Formato inválido.'],

            ['docId', 'trim'],
            ['docId', 'required'],
            ['docId', 'unique', 'targetClass' => '\common\models\Leitor', 'message' => 'Número de documento em uso.'],
            ['docId', 'string', 'min' => 9, 'max' => 45],

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
            ['codPostal', 'string', 'min' => 4, 'max' => 7],
            ['codPostal', 'match', 'pattern' => '/^[0-9]{4}|[0-9]{7}$/', 'message' => 'Formato inválido.'],

            ['telemovel', 'required'],
            ['telemovel', 'string', 'min' => 9, 'max' => 9],
            ['telemovel', 'match', 'pattern' => '/^[0-9]+$/', 'message' => 'Formato inválido.'],

            ['telefone', 'trim'],
            ['telefone', 'string', 'min' => 9, 'max' => 9],
            ['telefone', 'match', 'pattern' => '/^[0-9]+$/', 'message' => 'Formato inválido.'],

            ['notaInterna', 'trim'],
            ['notaInterna', 'string', 'min' => 1, 'max' => 45],

            ['Biblioteca_id', 'trim'],
            ['Biblioteca_id', 'integer'],
            ['Biblioteca_id', 'required'],

            ['TipoLeitor_id', 'trim'],
            ['TipoLeitor_id', 'integer'],
            ['TipoLeitor_id', 'required'],

            ['Curso_id', 'trim'],
            ['Curso_id', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave Primária',
            'codBarras' => 'Código de barras do leitor',
            'nome' => 'Nome do Leitor',
            'nif' => 'NIF',
            'docId' => 'Documento de Identificação',
            'dataNasc' => 'Data de Nascimento',
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'codPostal' => 'Código Postal',
            'telemovel' => 'Telemóvel',
            'telefone' => 'Telefone',
            'mail2' => 'E-mail (2)',
            'notaInterna' => 'Nota interna referente ao leitor',
            'dataRegisto' => 'Data Registado',
            'dataAtualizado' => 'Data Atualizado',
            'Biblioteca_id' => 'Biblioteca',
            'TipoLeitor_id' => 'Tipo de Leitor',
            'user_id' => 'User ID',
        ];
    }
    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if($this->validate()) {
            $auth = Yii::$app->authManager;
            $user = new User();
            $user->username = $this->username; //FIXME
            $user->email = $this->email;
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->status = 10;

            $leitor = new Leitor();
            $leitor->mail2 = $this->mail2;
            $leitor->nome = $this->nome;
            $leitor->nif = $this->nif;
            $user->setPassword($leitor->nif);
            $leitor->docId = $this->docId;
            $leitor->codBarras = $this->generateRandomString(9);
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
            $user->save();

            $leitor->user_id = $user->getId();

            if ($leitor->tipoLeitor->tipo == "aluno") {
                $leitor->save();
                $aluno = new Aluno();
                $aluno->numero = $this->numero;
                $aluno->Leitor_id = $leitor->id;
                $aluno->Curso_id = $this->Curso_id;
                $aluno->save();

                $leitorAlunoRole = $auth->getRole('leitorAluno');
                $auth->assign($leitorAlunoRole, $leitor->user_id);

            } elseif ($leitor->tipoLeitor->tipo == "docente") {
                $leitor->save();
                $funcionario = New Funcionario();
                $funcionario->departamento = $this->departamento;
                $funcionario->Leitor_id = $leitor->id;
                $funcionario->save();

                $leitorDocenteRole = $auth->getRole('leitorDocente');
                $auth->assign($leitorDocenteRole, $leitor->user_id);

            } elseif ($leitor->tipoLeitor->tipo == "funcionario") {
                $leitor->save();
                $funcionario = New Funcionario();
                $funcionario->departamento = $this->departamento;
                $funcionario->Leitor_id = $leitor->id;
                $funcionario->save();

                $leitorFuncionarioRole = $auth->getRole('leitorFuncionario');
                $auth->assign($leitorFuncionarioRole, $leitor->user_id);

            } elseif ($leitor->tipoLeitor->tipo == "externo") {
                $leitor->save();

                $leitorExternoRole = $auth->getRole('leitorExterno');
                $auth->assign($leitorExternoRole, $leitor->user_id);
            }


            return $leitor->id;
        }
        return false;
    }

    public function getRoles(){
    }
    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */

    public function generateRandomString($length = 13) {
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

    public function sendEmail(){

        $user = User::findOne([
            'email' => $this->email,
            'status' => User::STATUS_INACTIVE
        ]);

        if ($user === null) {
            return false;
        }

        Yii::$app->mailer->compose('emailVerify-text', ['user' => $user])
            ->setFrom('saramagoipl@gmail.com')
            ->setTo($this->email)
            ->setSubject('Confirmar email')
            ->send();

        return true;
    }
}
