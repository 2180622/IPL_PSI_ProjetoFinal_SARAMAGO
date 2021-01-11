<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cdu".
 *
 * @property int $id Chave primária
 * @property string $codCdu Código do Classificação Decimal Universal
 * @property string|null $designacao Designação
 *
 * @property Obra[] $obras
 */
class Cdu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cdu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codCdu', 'designacao'], 'required'],
            [['codCdu', 'designacao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'codCdu' => 'Código do Classificação Decimal Universal',
            'designacao' => 'Designação',
        ];
    }

    /**
     * Gets query for [[Obras]].
     *
     * @return \yii\db\ActiveQuery|ObraQuery
     */
    public function getObras()
    {
        return $this->hasMany(Obra::className(), ['Cdu_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CduQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CduQuery(get_called_class());
    }
}
