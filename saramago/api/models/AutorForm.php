<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Autor;
use DateTime;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

/**
 * AutorCreate form
 */
class AutorForm extends Autor
{
    public $id;
    public $primeiroNome;
    public $segundoNome;
    public $apelido;
    public $tipo;
    public $bibliografia;
    public $dataNasc;
    public $nacionalidade;
    public $orcid;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['primeiroNome', 'trim'],
            ['primeiroNome', 'required'],
            ['primeiroNome', 'string', 'min' => 2, 'max' => 255],

            ['segundoNome', 'trim'],
            ['segundoNome', 'string', 'max' => 255],

            ['apelido', 'trim'],
            ['apelido', 'string', 'max' => 255],

            ['tipo', 'trim'],
            ['tipo', 'required'],

            ['bibliografia', 'trim'],
            ['bibliografia', 'string'],

            ['dataNasc', 'trim'],
            ['dataNasc', 'required'],
            ['dataNasc', 'datetime', 'format' => 'dd/MM/yyyy', 'message' => 'Formato de data inválido.'],
            ['dataNasc', 'string', 'min' => 1, 'max' => 50],

            ['nacionalidade', 'trim'],
            ['nacionalidade', 'string', 'max' => 45],

            ['orcid', 'trim'],
            ['orcid', 'required'],
            ['orcid', 'unique', 'targetClass' => '\common\models\Autor', 'message' => 'Número de ORCID em uso.'],
            ['orcid', 'string', 'max' => 45],

        ];
    }

    /**
     * {@inheritdoc}
     */
   public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'primeiroNome' => 'Primeiro Nome',
            'segundoNome' => 'Segundo Nome',
            'apelido' => 'Apelido',
            'tipo' => 'Tipo de autor',
            'bibliografia' => 'Bibliografia do autor',
            'dataNasc' => 'Data de Nascimento',
            'nacionalidade' => 'Nacionalidade',
            'orcid' => 'Open Researcher and Contributor ID',
        ];
    }

    public function createAutor()
    {
        if($this->validate()) {

            $autor = new Autor();
            $autor->primeiroNome = $this->primeiroNome;
            $autor->segundoNome = $this->segundoNome;
            $autor->apelido = $this->apelido;
            $autor->tipo = $this->tipo;
            $autor->bibliografia = $this->bibliografia;
            $myDateTime = DateTime::createFromFormat('d/m/Y', $this->dataNasc);
            $newDateString = $myDateTime->format('Y/m/d');
            $autor->dataNasc = $newDateString;
            $autor->nacionalidade = $this->nacionalidade;
            $autor->orcid = $this->orcid;
            
            $autor->save();

            return $autor;
        }
        return false;
    }

    public function getRoles(){
    }

    public function findModel($id)
    {
        if (($model = Autor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
