<?php
namespace app\models;

use common\models\Obra;
use Yii;
use yii\base\Model;
use yii\helpers\Url;
use DateTime;


class ObraForm extends Obra
{
    public $id;
    public $imageFile;
    public $imgCapa;
    public $titulo;
    public $resumo;
    public $editor;
    public $ano;
    public $tipoObra;
    public $descricao;
    public $local;
    public $edicao;
    public $assuntos;
    public $preco;
    public $Cdu_id;
    public $Colecao_id;

    public function rules()
    {
        return [
            [['imageFile'], 'image', 'skipOnEmpty' => false,
                'mimeTypes' => 'image/gif, image/jpeg, image/png, image/x-icon',
                'checkExtensionByMimeType'=>true,
                'maxSize' => 1024 * 1024 * 2,
            ],
            ['imageFile', 'safe'],

            ['imgCapa', 'trim'],
            ['imgCapa', 'string', 'max' => 255],

            ['titulo', 'trim'],
            ['titulo', 'required'],
            ['titulo', 'string', 'max' => 255],

            ['resumo', 'trim'],
            ['resumo', 'string'],

            ['editor', 'trim'],
            ['editor', 'required'],
            ['editor', 'string', 'max' => 255],

            ['ano', 'required'],
            ['ano', 'integer'],

            ['tipoObra', 'required'],
            ['tipoObra', 'string'],

            ['descricao', 'required'],
            ['descricao', 'string', 'max' => 255],

            ['local', 'trim'],
            ['local', 'string', 'max' => 45],

            ['edicao', 'trim'],
            ['edicao', 'string', 'max' => 45],

            ['assuntos', 'string', 'max' => 255],

            ['preco', 'number'],

            ['dataRegisto', 'trim'],
            ['dataRegisto', 'required'],
            ['dataRegisto', 'datetime', 'format' => 'dd/MM/yyyy', 'message' => 'Formato de data inválido.'],
            ['dataRegisto', 'string', 'min' => 1, 'max' => 50],

            ['Cdu_id', 'integer'],

            ['Colecao_id', 'integer'],
        ];
    }

        public function attributeLabels()
    {
        return [
            'id' => 'Chave Primária',
            'imgCapa' => 'Capa da Obra',
            'titulo' => 'Titulo da Obra',
            'resumo' => 'Resumo da Obra',
            'editor' => 'Editor da Obra',
            'ano' => 'Ano da Obra',
            'tipoObra' => 'Tipo de Obra',
            'descricao' => 'Descrição da Obra',
            'local' => 'Local',
            'edicao' => 'Edição',
            'assuntos' => 'Assuntos',
            'preco' => 'Preço',
            'dataRegisto' => 'Data Registado',
            'dataAtualizado' => 'Data Atualizado',
            'Cdu_id' => 'Chave estrangeira',
            'Colecao_id' => 'Chave estrangeira',
        ];
    }

    public function createObra(){
        if($this->validate()) {
            $obra = new Obra();
            $obra->imgCapa = $this->upload();
            $obra->titulo = $this->titulo;

            $obra->resumo = $this->resumo;
            $obra->editor = $this->editor;

            $obra->ano = $this->ano;
            $obra->tipoObra = $this->tipoObra;
            $obra->descricao = $this->descricao;

            $obra->local = $this->local;
            $obra->edicao = $this->edicao;
            $obra->assuntos = $this->assuntos;
            $obra->preco = $this->preco;

            $myDateTime = DateTime::createFromFormat('d/m/Y', $this->dataNasc);
            $newDateString = $myDateTime->format('Y/m/d');
            $obra->dataRegisto = $newDateString;

            $obra->Cdu_id = $this->Cdu_id;
            $obra->Colecao_id = $this->Colecao_id;

            $obra->save();

            return $obra;
        }
        return false;
    }

    public function upload()
    {
        $this->imgCapa = 'obra-'.$this->id;
        $this->imageFile->saveAs(Url::to('img/' . $this->imgCapa . '.' . $this->imageFile->extension));
        $this->imgCapa = $this->imgCapa . '.' . $this->imageFile->extension;

        return $this->imgCapa;
    }
}