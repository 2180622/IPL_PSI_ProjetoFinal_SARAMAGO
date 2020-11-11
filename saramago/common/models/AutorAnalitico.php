<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "autor_analitico".
 *
 * @property int $Autor_id
 * @property int $Analitico_id
 *
 * @property Analitico $analitico
 * @property Autor $autor
 */
class AutorAnalitico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'autor_analitico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Autor_id', 'Analitico_id'], 'required'],
            [['Autor_id', 'Analitico_id'], 'integer'],
            [['Autor_id', 'Analitico_id'], 'unique', 'targetAttribute' => ['Autor_id', 'Analitico_id']],
            [['Analitico_id'], 'exist', 'skipOnError' => true, 'targetClass' => Analitico::className(), 'targetAttribute' => ['Analitico_id' => 'id']],
            [['Autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Autor::className(), 'targetAttribute' => ['Autor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Autor_id' => 'Autor ID',
            'Analitico_id' => 'Analitico ID',
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
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery|AutorQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autor::className(), ['id' => 'Autor_id']);
    }

    /**
     * {@inheritdoc}
     * @return AutorAnaliticoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AutorAnaliticoQuery(get_called_class());
    }
}
