<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fundo".
 *
 * @property int $id Chave primária
 * @property string $designacao
 * @property int $Exemplar_id Chave estrangeira
 *
 * @property Exemplar $exemplar
 */
class Fundo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fundo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'designacao'], 'required'],
            [['id'], 'integer'],
            [['designacao'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'designacao' => 'Designacao',
        ];
    }

    /**
     * Gets query for [[Exemplars]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplars()
    {
        return $this->hasMany(Exemplar::className(), ['Fundo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FundoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FundoQuery(get_called_class());
    }
}
