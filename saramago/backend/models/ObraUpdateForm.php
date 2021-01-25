<?php
namespace backend\models;

use common\models\Cdu;
use common\models\Colecao;
use common\models\Materialav;
use common\models\Monografia;
use common\models\Obra;
use common\models\Pubperiodica;
use Yii;
use yii\base\Model;
use yii\helpers\Url;
use DateTime;
use yii\web\UploadedFile;


class ObraUpdateForm extends Obra
{
    //Base
    public $id, $imgCapa, $titulo, $resumo, $editor, $ano, $tipoObra, $descricao, $local, $edicao, $assuntos, $preco, $dataAtualizado, $Cdu_id, $Colecao_id;

    //Shared
    public $imageFile, $volume, $paginas, $serie, $numero, $isbn, $ISSN, $ean, $duracao, $Obra_id;

    const MONOGRAFIA = 'monografia';
    const MATERIALAV = 'materialAv';
    const PUBPERIODICA = 'pubPeriodica';

    //Shared - Monografia (id, volume, paginas, isbn, Obra_id);
    //Shared - Material Audio-Visual (id, duracao, ean, Obra_id);
    //Shared - Publicações Periodicas (id, volume, serie, numero, ISNN, Obra_id);

    public function scenarios()
    {
        return [
            self::MONOGRAFIA => [
                //base
                'id',['imageFile', 'safe'],'imgCapa', 'titulo', 'resumo', 'editor', 'ano', 'tipoObra', 'descricao', 'local', 'edicao', 'assuntos', 'preco', 'dataAtualizado', 'Cdu_id','Colecao_id',
                //extra
                'volume','paginas','isbn','Obra_id',

            ],
            self::MATERIALAV => [
                //base
                'id','imageFile', 'imgCapa', 'titulo', 'resumo', 'editor', 'ano', 'tipoObra', 'descricao', 'local', 'edicao', 'assuntos', 'preco','dataAtualizado', 'Cdu_id','Colecao_id',
                //extra
                'duracao','ean','Obra_id',
            ],
            self::PUBPERIODICA => [
                //base
                'id','imageFile','imgCapa', 'titulo', 'resumo', 'editor', 'ano', 'tipoObra', 'descricao', 'local', 'edicao','assuntos', 'preco', 'dataAtualizado', 'Cdu_id','Colecao_id',
                //extra
                'volume', 'serie','numero','ISSN', 'Obra_id',
            ],
        ];
    }

    public function rules()
    {
        return [
                #region Base Rules
                [['imageFile'], 'image', 'skipOnEmpty' => true,
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

                ['ano', 'trim'],
                ['ano', 'required'],
                ['ano', 'integer', 'min'=>1901 ,'max' => 2155],

                ['tipoObra', 'required'],
                ['tipoObra', 'string'],

                ['descricao', 'trim'],
                ['descricao', 'required'],
                ['descricao', 'string', 'max' => 255],

                ['local', 'trim'],
                ['local', 'string', 'max' => 45],

                ['edicao', 'trim'],
                ['edicao', 'string', 'max' => 45],

                ['assuntos', 'trim'],
                ['assuntos', 'string', 'max' => 255],
                //FIXME pattern em assuntos

                ['preco', 'trim'],
                ['preco', 'double'],

                [['Cdu_id'], 'exist', 'skipOnError' => false, 'targetClass' => Cdu::className(), 'targetAttribute' => ['Cdu_id' => 'id']],
                [['Colecao_id'], 'exist', 'skipOnError' => false, 'targetClass' => Colecao::className(), 'targetAttribute' => ['Colecao_id' => 'id']],

            #endregion

            #region Extra Rules
                ['volume', 'trim'],
                ['volume', 'string', 'max' => 45],

                ['serie', 'trim'],
                ['serie', 'string', 'max' => 45],

                ['numero', 'trim'],
                ['numero', 'required'],
                ['numero', 'string', 'max' => 45],

                ['paginas', 'trim'],
                ['paginas', 'required'],
                ['paginas', 'number', 'max' => 999999],

                ['isbn', 'trim'],
                ['isbn', 'required'],
                ['isbn', 'string', 'max'=>13],

                ['ISSN', 'trim'],
                ['ISSN', 'required'],
                ['ISSN', 'string', 'max'=>8],

                ['ean', 'trim'],
                ['ean', 'required'],
                ['ean', 'number', 'min'=>000000000001,'max'=>9999999999999],

                ['duracao', 'trim'],
                ['duracao', 'required'],
                ['duracao', 'number', 'max'=>999999],

                [['Obra_id'], 'exist', 'skipOnError' => false, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],

            #endregion

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Chave Primária',
            'imgCapa' => 'Capa',
            'titulo' => 'Titulo ',
            'resumo' => 'Resumo',
            'editor' => 'Editor',
            'ano' => 'Ano',
            'tipoObra' => 'Tipo de Obra',
            'descricao' => 'Descrição',
            'local' => 'Local',
            'edicao' => 'Edição',
            'assuntos' => 'Assuntos',
            'preco' => 'Preço',
            'dataRegisto' => 'Data Registo',
            'dataAtualizado' => 'Data Atualizado',
            'Cdu_id' => 'CDU',
            'Colecao_id' => 'Coleção',
            'paginas'=>'Páginas',
            'volume'=>'Volume',
            'ean'=>'EAN',
            'isbn'=>'ISBN',
            'serie'=>'Série',
            'duracao'=>'Duração',
            'numero'=>'Número',
            'ISSN'=>'ISSN',

        ];
    }

    /**
     * ObraUpdateForm constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $obra = $this->findModel($id);

        $this->id = $obra->id;
        $this->imgCapa = $obra->imgCapa;
        $this->imageFile = $obra->imgCapa;
        $this->titulo = $obra->titulo;
        $this->resumo = $obra->resumo;
        $this->editor = $obra->editor;

        $this->ano = $obra->ano;
        $this->tipoObra = $obra->tipoObra;
        $this->descricao = $obra->descricao;

        $this->local = $obra->local;
        $this->edicao = $obra->edicao;
        $this->assuntos = $obra->assuntos;
        $this->preco = $obra->preco;
        $this->Cdu_id = $obra->Cdu_id;
        $this->Colecao_id = $obra->Colecao_id;

        if($obra->tipoObra == self::MONOGRAFIA)
        {
            $monografia = Monografia::findOne(['Obra_id'=>$obra->id]);
            $this->paginas = $monografia->paginas;
            $this->volume = $monografia->volume;
            $this->isbn = $monografia->isbn;

        }
        elseif($obra->tipoObra == self::MATERIALAV)
        {
            $materialAv = Materialav::findOne(['Obra_id'=>$obra->id]);
            $this->duracao = $materialAv->duracao;
            $this->ean = $materialAv->ean;
        }
        elseif ($obra->tipoObra == self::PUBPERIODICA)
        {
            $pubPeriodica = Pubperiodica::findOne(['Obra_id'=>$obra->id]);
            $this->volume = $pubPeriodica->volume;
            $this->serie = $pubPeriodica->serie;
            $this->numero = $pubPeriodica->numero;
            $this->ISSN = $pubPeriodica->ISSN;

        }
    }

    /**
     * @return false
     */
    public function updateObra()
    {
        if($this->validate())
        {
            $obra = Obra::findOne($this->id);

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

            $obra->dataAtualizado = date('y-m-d H:i:s');

            $obra->Cdu_id = $this->Cdu_id;
            $obra->Colecao_id = $this->Colecao_id;

            if($this->imageFile != null)
            {

                $this->imgCapa = 'obra-'.md5('saramago-obra'.rand('1', '100').$this->titulo);
                $this->imageFile->saveAs(Url::to('img/' . $this->imgCapa . '.' . $this->imageFile->extension));
                $obra->imgCapa = $this->imgCapa. '.' . $this->imageFile->extension;
            }else
                {
                    if($this->imgCapa != null)
                    {
                        unlink(Url::to('img/' . $this->imgCapa));
                        $obra->imgCapa = null;
                    }
                }

            $obra->save();

            if($obra->tipoObra == self::MONOGRAFIA)
            {
                $monografia = Monografia::find()->where('Obra_id='.$obra->id)->one();
                $monografia->paginas = $this->paginas;
                $monografia->volume = $this->volume;
                $monografia->isbn = $this->isbn;

                $monografia->save();

            }
            elseif($obra->tipoObra == self::MATERIALAV)
            {
                $materialAv = Materialav::find()->where('Obra_id='.$obra->id)->one();
                $materialAv->duracao = $this->duracao;
                $materialAv->ean = $this->ean;
                $materialAv->Obra_id = $obra->id;

                $materialAv->save();

            }
            elseif ($obra->tipoObra == self::PUBPERIODICA)
            {
                $pubPeriodica = Pubperiodica::find()->where('Obra_id='.$obra->id)->one();
                $pubPeriodica->volume = $this->volume;
                $pubPeriodica->serie = $this->serie;
                $pubPeriodica->numero = $this->numero;
                $pubPeriodica->ISSN = $this->ISSN;
                $pubPeriodica->Obra_id = $obra->id;

                $pubPeriodica->save();
            }

            return true;
        }
        else {return false;}

    }

    /**
     * @param $id
     * @return Obra|null
     */
    public function findModel($id)
    {
        if (($model = Obra::findOne($id)) !== null) {
            return $model;
        }
    }


}