<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "analitico_obra".
 *
 * @property int $Analitico_id
 * @property int $Obra_id
 *
 * @property Analitico $analitico
 * @property Obra $obra
 */
class AnaliticoObra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'analitico_obra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Analitico_id', 'Obra_id'], 'required'],
            [['Analitico_id', 'Obra_id'], 'integer'],
            [['Analitico_id', 'Obra_id'], 'unique', 'targetAttribute' => ['Analitico_id', 'Obra_id']],
            [['Analitico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Analitico::className(), 'targetAttribute' => ['Analitico_id' => 'id']],
            [['Obra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Analitico_id' => 'Analitico ID',
            'Obra_id' => 'Obra ID',
        ];
    }

    /**
     * Gets query for [[Analitico]].
     *
     * @return \yii\db\ActiveQuery|AnaliticoQuery
     */
    public function getAnalitico()
    {
        return $this->hasOne(Analitico::className(), ['id' => 'Analitico_id']);
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
     * @return AnaliticoObraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnaliticoObraQuery(get_called_class());
    }
}
