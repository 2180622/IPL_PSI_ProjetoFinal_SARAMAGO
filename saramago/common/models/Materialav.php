<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "materialav".
 *
 * @property int $id Chave primária
 * @property string $duracao Duração (min)
 * @property int $ean Código de Barras EAN-13
 * @property int $Obra_id Chave estrangeira
 *
 * @property Obra $obra
 */
class Materialav extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materialav';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duracao', 'ean', 'Obra_id'], 'required'],
            [['ean', 'Obra_id'], 'integer'],
            [['duracao'], 'string', 'max' => 45],
            [['Obra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'duracao' => 'Duração (min)',
            'ean' => 'Código de Barras EAN-13',
            'Obra_id' => 'Chave estrangeira',
        ];
    }

    /**
     * Gets query for [[Obra]].
     *
     * @return \yii\db\ActiveQuery|ObraQuery
     */
    public function getObra()
    {
        return $this->hasOne(Obra::className(), ['id' => 'Obra_id']);
    }

    /**
     * {@inheritdoc}
     * @return MaterialavQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialavQuery(get_called_class());
    }
}
