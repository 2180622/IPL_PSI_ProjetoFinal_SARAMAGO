<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pubperiodica".
 *
 * @property int $id Chave primária
 * @property string|null $volume Volume
 * @property string|null $serie Série
 * @property int $numero Número
 * @property int $ISSN International Standard Serial Number
 * @property int $Obra_id Chave estrangeira
 *
 * @property Obra $obra
 */
class Pubperiodica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pubperiodica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'ISSN', 'Obra_id'], 'required'],
            [['numero', 'ISSN', 'Obra_id'], 'integer'],
            [['volume', 'serie'], 'string', 'max' => 45],
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
            'volume' => 'Volume',
            'serie' => 'Série',
            'numero' => 'Número',
            'ISSN' => 'International Standard Serial Number',
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
     * @return PubperiodicaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PubperiodicaQuery(get_called_class());
    }
}
