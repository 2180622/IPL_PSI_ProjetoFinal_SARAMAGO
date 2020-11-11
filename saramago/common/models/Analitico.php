<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "analitico".
 *
 * @property int $id Chave primaria
 * @property string $titulo Título do analítico 
 * @property int $paginas Número de páginas
 *
 * @property AnaliticoObra[] $analiticoObras
 * @property Obra[] $obras
 * @property AutorAnalitico[] $autorAnaliticos
 * @property Autor[] $autors
 */
class Analitico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'analitico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'paginas'], 'required'],
            [['titulo'], 'string'],
            [['paginas'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primaria',
            'titulo' => 'Título do analítico ',
            'paginas' => 'Número de páginas',
        ];
    }

    /**
     * Gets query for [[AnaliticoObras]].
     *
     * @return \yii\db\ActiveQuery|AnaliticoObraQuery
     */
    public function getAnaliticoObras()
    {
        return $this->hasMany(AnaliticoObra::className(), ['Analitico_id' => 'id']);
    }

    /**
     * Gets query for [[Obras]].
     *
     * @return \yii\db\ActiveQuery|ObraQuery
     */
    public function getObras()
    {
        return $this->hasMany(Obra::className(), ['id' => 'Obra_id'])->viaTable('analitico_obra', ['Analitico_id' => 'id']);
    }

    /**
     * Gets query for [[AutorAnaliticos]].
     *
     * @return \yii\db\ActiveQuery|AutorAnaliticoQuery
     */
    public function getAutorAnaliticos()
    {
        return $this->hasMany(AutorAnalitico::className(), ['Analitico_id' => 'id']);
    }

    /**
     * Gets query for [[Autors]].
     *
     * @return \yii\db\ActiveQuery|AutorQuery
     */
    public function getAutors()
    {
        return $this->hasMany(Autor::className(), ['id' => 'Autor_id'])->viaTable('autor_analitico', ['Analitico_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AnaliticoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnaliticoQuery(get_called_class());
    }
}
