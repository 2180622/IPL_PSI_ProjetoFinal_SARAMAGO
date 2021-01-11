<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "obra".
 *
 * @property int $id Chave primária
 * @property string|null $imgCapa Imagem da Capa
 * @property string $titulo Titulo da obra
 * @property string|null $resumo Resumo da obra
 * @property string $editor Editor
 * @property string $ano Ano
 * @property string $tipoObra Tipo de obra
 * @property string $descricao Descrição da Obra
 * @property string|null $local Local
 * @property string|null $edicao Edição
 * @property string|null $assuntos Assuntos
 * @property float|null $preco Preço (€)
 * @property string $dataRegisto Data registado
 * @property string|null $dataAtualizado Data atualizado
 * @property int $Cdu_id Chave estrangeira
 * @property int|null $Colecao_id Chave estrangeira
 *
 * @property AnaliticoObra[] $analiticoObras
 * @property Analitico[] $analiticos
 * @property Exemplar[] $exemplars
 * @property Leiturarecomendada[] $leiturarecomendadas
 * @property Materialav[] $materialavs
 * @property Monografia[] $monografias
 * @property Cdu $cdu
 * @property Colecao $colecao
 * @property ObraAutor[] $obraAutors
 * @property Autor[] $autors
 * @property Pubperiodica[] $pubperiodicas
 * @property Reprografia[] $reprografias
 * @property Sugestaoaquisicao[] $sugestaoaquisicaos
 */
class Obra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'editor', 'ano', 'tipoObra', 'descricao', 'Cdu_id'], 'required'],
            [['resumo', 'tipoObra'], 'string'],
            [['ano', 'dataRegisto', 'dataAtualizado'], 'safe'],
            [['preco'], 'number'],
            [['Cdu_id', 'Colecao_id'], 'integer'],
            [['imgCapa', 'editor', 'descricao', 'assuntos'], 'string', 'max' => 255],
            [['titulo', 'local', 'edicao'], 'string', 'max' => 45],
            [['Cdu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cdu::className(), 'targetAttribute' => ['Cdu_id' => 'id']],
            [['Colecao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colecao::className(), 'targetAttribute' => ['Colecao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'imgCapa' => 'Imagem da Capa',
            'titulo' => 'Titulo da obra',
            'resumo' => 'Resumo da obra',
            'editor' => 'Editor',
            'ano' => 'Ano',
            'tipoObra' => 'Tipo de obra',
            'descricao' => 'Descrição da Obra',
            'local' => 'Local',
            'edicao' => 'Edição',
            'assuntos' => 'Assuntos',
            'preco' => 'Preço (€)',
            'dataRegisto' => 'Data registado',
            'dataAtualizado' => 'Data atualizado',
            'Cdu_id' => 'Chave estrangeira',
            'Colecao_id' => 'Chave estrangeira',
        ];
    }

    /**
     * Gets query for [[AnaliticoObras]].
     *
     * @return \yii\db\ActiveQuery|AnaliticoObraQuery
     */
    public function getAnaliticoObras()
    {
        return $this->hasMany(AnaliticoObra::className(), ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Analiticos]].
     *
     * @return \yii\db\ActiveQuery|AnaliticoQuery
     */
    public function getAnaliticos()
    {
        return $this->hasMany(Analitico::className(), ['id' => 'Analitico_id'])->viaTable('analitico_obra', ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Exemplars]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplars()
    {
        return $this->hasMany(Exemplar::className(), ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Leiturarecomendadas]].
     *
     * @return \yii\db\ActiveQuery|LeiturarecomendadaQuery
     */
    public function getLeiturarecomendadas()
    {
        return $this->hasMany(Leiturarecomendada::className(), ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Materialavs]].
     *
     * @return \yii\db\ActiveQuery|MaterialavQuery
     */
    public function getMaterialavs()
    {
        return $this->hasMany(Materialav::className(), ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Monografias]].
     *
     * @return \yii\db\ActiveQuery|MonografiaQuery
     */
    public function getMonografias()
    {
        return $this->hasMany(Monografia::className(), ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Cdu]].
     *
     * @return \yii\db\ActiveQuery|CduQuery
     */
    public function getCdu()
    {
        return $this->hasOne(Cdu::className(), ['id' => 'Cdu_id']);
    }

    /**
     * Gets query for [[Colecao]].
     *
     * @return \yii\db\ActiveQuery|ColecaoQuery
     */
    public function getColecao()
    {
        return $this->hasOne(Colecao::className(), ['id' => 'Colecao_id']);
    }

    /**
     * Gets query for [[ObraAutors]].
     *
     * @return \yii\db\ActiveQuery|ObraAutorQuery
     */
    public function getObraAutors()
    {
        return $this->hasMany(ObraAutor::className(), ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Autors]].
     *
     * @return \yii\db\ActiveQuery|AutorQuery
     */
    public function getAutors()
    {
        return $this->hasMany(Autor::className(), ['id' => 'Autor_id'])->viaTable('obra_autor', ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Pubperiodicas]].
     *
     * @return \yii\db\ActiveQuery|PubperiodicaQuery
     */
    public function getPubperiodicas()
    {
        return $this->hasMany(Pubperiodica::className(), ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Reprografias]].
     *
     * @return \yii\db\ActiveQuery|ReprografiaQuery
     */
    public function getReprografias()
    {
        return $this->hasMany(Reprografia::className(), ['Obra_id' => 'id']);
    }

    /**
     * Gets query for [[Sugestaoaquisicaos]].
     *
     * @return \yii\db\ActiveQuery|SugestaoaquisicaoQuery
     */
    public function getSugestaoaquisicaos()
    {
        return $this->hasMany(Sugestaoaquisicao::className(), ['Obra_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ObraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ObraQuery(get_called_class());
    }

    #region Obra

    public static function getAssuntosDasObrasTodas() {
        $obrasTodas = Obra::find()->all();
        $tagsTodas = null;
        foreach ($obrasTodas as $obra) {
            $tagsTodas .= $obra->assuntos . ', ';
        }
        $tagsTodas = implode(', ',array_unique(explode(', ', $tagsTodas)));
        $tags = explode(', ', $tagsTodas);
        array_pop($tags);

        return $tags;
    }

    public static function getLivrosComMesmoAssunto() {
        $obrasTodas = Obra::find()->all();
        $primeiro = true;
        $tagsTodas = null;
        foreach ($obrasTodas as $obra) {
            if ($primeiro) {
                $tagsTodas = $obra->assuntos;
                $primeiro = false;
            }
            else {
                $tagsTodas .= ', ' . $obra->assuntos;
            }

        }
        $contagemTotal = Obra::NumeroDePalavrasIguais($tagsTodas);

        return $contagemTotal;
    }


    public static function getAnosDasObrasTodas() {
        $obrasTodas = Obra::find()->all();
        $anosTodos = null;
        foreach ($obrasTodas as $obra) {
            $anosTodos .= $obra->ano . ', ';
        }
        $anosTodos = implode(', ',array_unique(explode(', ', $anosTodos)));
        $anos = explode(', ', $anosTodos);
        array_pop($anos);

        return $anos;
    }


    public static function getLivrosComMesmoAno() {
        $obrasTodas = Obra::find()->all();
        $primeiro = true;
        $anosTodos = null;
        foreach ($obrasTodas as $obra) {
            if ($primeiro) {
                $anosTodos = $obra->ano;
                $primeiro = false;
            }
            else {
                $anosTodos .= ', ' . $obra->ano;
            }
        }
        $contagemTotal = Obra::NumeroDeNumerosIguais($anosTodos);

        return $contagemTotal;
    }

    public static function NumeroDePalavrasIguais($frase) {
        $contagem = array();
        
        $palavras = explode(', ', $frase);
        foreach ($palavras as $palavra) {
            $palavra = preg_replace("#[^a-zA-Z\-]#", "", $palavra);
            if (isset($contagem[$palavra])) {
                $contagem[$palavra] += 1;
            }
            else {
                $contagem[$palavra] = 1;
            }
        }
        
        return $contagem;
    }

    public static function NumeroDeNumerosIguais($frase) {
        $contagem = array();
        
        $numeros = explode(', ', $frase);
        foreach ($numeros as $numero) {
            $numero = preg_replace("/[^0-9]/", "", $numero);
            if (isset($contagem[$numero])) {
                $contagem[$numero] += 1;
            }
            else {
                $contagem[$numero] = 1;
            }
        }
        
        return $contagem;
    }

    #endRegion
}
