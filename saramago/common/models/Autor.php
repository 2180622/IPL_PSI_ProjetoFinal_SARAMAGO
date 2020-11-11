<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "autor".
 *
 * @property int $id Chave primária
 * @property string $primeiroNome Primeiro Nome
 * @property string|null $segundoNome Segundo Nome
 * @property string|null $apelido Apelido
 * @property string $tipo Tipo de autor
 * @property string|null $bibliografia Bibliografia do autor
 * @property string|null $dataNasc Data de Nascimento
 * @property string|null $nacionalidade Nacionalidade
 * @property string|null $orcid Open Researcher and Contributor ID
 *
 * @property AutorAnalitico[] $autorAnaliticos
 * @property Analitico[] $analiticos
 * @property ObraAutor[] $obraAutors
 * @property Obra[] $obras
 */
class Autor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'autor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['primeiroNome', 'tipo'], 'required'],
            [['tipo', 'bibliografia'], 'string'],
            [['dataNasc'], 'safe'],
            [['primeiroNome', 'segundoNome', 'apelido'], 'string', 'max' => 255],
            [['nacionalidade', 'orcid'], 'string', 'max' => 45],
            [['orcid'], 'unique'],
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

    /**
     * Gets query for [[AutorAnaliticos]].
     *
     * @return \yii\db\ActiveQuery|AutorAnaliticoQuery
     */
    public function getAutorAnaliticos()
    {
        return $this->hasMany(AutorAnalitico::className(), ['Autor_id' => 'id']);
    }

    /**
     * Gets query for [[Analiticos]].
     *
     * @return \yii\db\ActiveQuery|AnaliticoQuery
     */
    public function getAnaliticos()
    {
        return $this->hasMany(Analitico::className(), ['id' => 'Analitico_id'])->viaTable('autor_analitico', ['Autor_id' => 'id']);
    }

    /**
     * Gets query for [[ObraAutors]].
     *
     * @return \yii\db\ActiveQuery|ObraAutorQuery
     */
    public function getObraAutors()
    {
        return $this->hasMany(ObraAutor::className(), ['Autor_id' => 'id']);
    }

    /**
     * Gets query for [[Obras]].
     *
     * @return \yii\db\ActiveQuery|ObraQuery
     */
    public function getObras()
    {
        return $this->hasMany(Obra::className(), ['id' => 'Obra_id'])->viaTable('obra_autor', ['Autor_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AutorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AutorQuery(get_called_class());
    }
}
