<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property int $id
 * @property string $CodCurso
 * @property string $nome
 *
 * @property Aluno[] $alunos
 * @property CursoUc[] $cursoUcs
 * @property Uc[] $ucs
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CodCurso', 'nome'], 'required'],
            [['CodCurso', 'nome'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CodCurso' => 'Cod Curso',
            'nome' => 'Nome',
        ];
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery|AlunoQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Aluno::className(), ['Curso_id' => 'id']);
    }

    /**
     * Gets query for [[CursoUcs]].
     *
     * @return \yii\db\ActiveQuery|CursoUcQuery
     */
    public function getCursoUcs()
    {
        return $this->hasMany(CursoUc::className(), ['Curso_id' => 'id']);
    }

    /**
     * Gets query for [[Ucs]].
     *
     * @return \yii\db\ActiveQuery|UcQuery
     */
    public function getUcs()
    {
        return $this->hasMany(Uc::className(), ['id' => 'Uc_id'])->viaTable('curso_uc', ['Curso_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CursoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CursoQuery(get_called_class());
    }
}
