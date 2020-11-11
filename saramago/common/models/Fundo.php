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
            [['id', 'designacao', 'Exemplar_id'], 'required'],
            [['id', 'Exemplar_id'], 'integer'],
            [['designacao'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['Exemplar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exemplar::className(), 'targetAttribute' => ['Exemplar_id' => 'id']],
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
            'Exemplar_id' => 'Chave estrangeira',
        ];
    }

    /**
     * Gets query for [[Exemplar]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplar()
    {
        return $this->hasOne(Exemplar::className(), ['id' => 'Exemplar_id']);
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
