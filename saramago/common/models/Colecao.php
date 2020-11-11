<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "colecao".
 *
 * @property int $id Chave primária
 * @property string $tituloColecao Titulo da coleção
 *
 * @property Obra[] $obras
 */
class Colecao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colecao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tituloColecao'], 'required'],
            [['tituloColecao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'tituloColecao' => 'Titulo da coleção',
        ];
    }

    /**
     * Gets query for [[Obras]].
     *
     * @return \yii\db\ActiveQuery|ObraQuery
     */
    public function getObras()
    {
        return $this->hasMany(Obra::className(), ['Colecao_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ColecaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ColecaoQuery(get_called_class());
    }
}
