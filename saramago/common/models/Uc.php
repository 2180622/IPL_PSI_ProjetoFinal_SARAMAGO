<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uc".
 *
 * @property int $id
 * @property string $designacao Unidade curricular
 *
 * @property CursoUc[] $cursoUcs
 * @property Curso[] $cursos
 * @property Leiturarecomendada[] $leiturarecomendadas
 */
class Uc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uc';
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
            'id' => 'ID',
            'designacao' => 'Unidade curricular',
        ];
    }

    /**
     * Gets query for [[CursoUcs]].
     *
     * @return \yii\db\ActiveQuery|CursoUcQuery
     */
    public function getCursoUcs()
    {
        return $this->hasMany(CursoUc::className(), ['Uc_id' => 'id']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery|CursoQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::className(), ['id' => 'Curso_id'])->viaTable('curso_uc', ['Uc_id' => 'id']);
    }

    /**
     * Gets query for [[Leiturarecomendadas]].
     *
     * @return \yii\db\ActiveQuery|LeiturarecomendadaQuery
     */
    public function getLeiturarecomendadas()
    {
        return $this->hasMany(Leiturarecomendada::className(), ['Uc_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UcQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UcQuery(get_called_class());
    }
}
