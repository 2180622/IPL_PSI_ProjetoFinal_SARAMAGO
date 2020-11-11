<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "curso_uc".
 *
 * @property int $Curso_id
 * @property int $Uc_id
 *
 * @property Curso $curso
 * @property Uc $uc
 */
class CursoUc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso_uc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Curso_id', 'Uc_id'], 'required'],
            [['Curso_id', 'Uc_id'], 'integer'],
            [['Curso_id', 'Uc_id'], 'unique', 'targetAttribute' => ['Curso_id', 'Uc_id']],
            [['Curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['Curso_id' => 'id']],
            [['Uc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Uc::className(), 'targetAttribute' => ['Uc_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Curso_id' => 'Curso ID',
            'Uc_id' => 'Uc ID',
        ];
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery|CursoQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'Curso_id']);
    }

    /**
     * Gets query for [[Uc]].
     *
     * @return \yii\db\ActiveQuery|UcQuery
     */
    public function getUc()
    {
        return $this->hasOne(Uc::className(), ['id' => 'Uc_id']);
    }

    /**
     * {@inheritdoc}
     * @return CursoUcQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CursoUcQuery(get_called_class());
    }
}
