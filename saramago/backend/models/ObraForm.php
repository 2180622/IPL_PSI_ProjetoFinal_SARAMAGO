<?php
namespace backend\models;

use common\models\Cdu;
use common\models\Colecao;
use common\models\Materialav;
use common\models\Monografia;
use common\models\Obra;
use common\models\Pubperiodica;
use yii\helpers\Url;


class ObraForm extends Obra
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
                'id','imageFile','imgCapa', 'titulo', 'resumo', 'editor', 'ano', 'tipoObra', 'descricao', 'local', 'edicao', 'assuntos', 'preco', 'dataAtualizado', 'Cdu_id','Colecao_id',
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
     * @return false|int
     */
    public function create()
    {
        if($this->validate())
        {
            $obra = new Obra();

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

            $obra->dataAtualizado = date('y-m-d h:m');

            $obra->Cdu_id = $this->Cdu_id;
            $obra->Colecao_id = $this->Colecao_id;

            if($this->imageFile != null)
            {

                $this->imgCapa = 'obra-'.md5('saramago-obra'.rand('1', '100').$this->titulo);
                $this->imageFile->saveAs(Url::to('img/' . $this->imgCapa . '.' . $this->imageFile->extension));
                $obra->imgCapa = $this->imgCapa. '.' . $this->imageFile->extension;
            }

            $obra->save();

            if($obra->tipoObra == self::MONOGRAFIA)
            {
                $monografia = new Monografia();

                $monografia->paginas = $this->paginas;
                $monografia->volume = $this->volume;
                $monografia->isbn = $this->isbn;
                $monografia->Obra_id = $obra->id;

                $monografia->save();

            }elseif($obra->tipoObra == self::MATERIALAV)
            {
                $materialAv = new Materialav();

                $materialAv->duracao = $this->duracao;
                $materialAv->ean = $this->ean;
                $materialAv->Obra_id = $obra->id;

                $materialAv->save();

            }elseif ($obra->tipoObra == self::PUBPERIODICA)
            {
                $pubPeriodica = new Pubperiodica();

                $pubPeriodica->volume = $this->volume;
                $pubPeriodica->serie = $this->serie;
                $pubPeriodica->numero = $this->numero;
                $pubPeriodica->ISSN = $this->ISSN;
                $pubPeriodica->Obra_id = $obra->id;

                $pubPeriodica->save();

            }

            return $obra->id;

        }else
            {
                return false;
            }
    }
}