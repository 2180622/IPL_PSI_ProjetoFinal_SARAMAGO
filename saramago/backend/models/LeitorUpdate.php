<?php


namespace app\models;


use common\models\Leitor;
use common\models\User;
use DateTime;
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
        // temporary fix
        //$leitorAlunoRole = $auth->getRole('leitorAluno');
        //$auth->assign($leitorAlunoRole, $user->getId());
    }

    public function updateLeitor()
    {
        $leitor = Leitor::findOne($this->id);
        $user = User::findOne($leitor->user_id);

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->status = 10;
        $user->save();

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

        $user->save();

        $leitor->save();

        return $leitor && $user;
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