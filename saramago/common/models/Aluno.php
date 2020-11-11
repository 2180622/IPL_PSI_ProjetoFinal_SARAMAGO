<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property int $id Chave primária
 * @property int $numero Número do aluno
 * @property int $Leitor_id Chave estrangeira
 * @property int|null $Curso_id Chave estrangeira
 *
 * @property Curso $curso
 * @property Leitor $leitor
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'Leitor_id'], 'required'],
            [['numero', 'Leitor_id', 'Curso_id'], 'integer'],
            [['Curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['Curso_id' => 'id']],
            [['Leitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leitor::className(), 'targetAttribute' => ['Leitor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'numero' => 'Número do aluno',
            'Leitor_id' => 'Chave estrangeira',
            'Curso_id' => 'Chave estrangeira',
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
     * Gets query for [[Leitor]].
     *
     * @return \yii\db\ActiveQuery|LeitorQuery
     */
    public function getLeitor()
    {
        return $this->hasOne(Leitor::className(), ['id' => 'Leitor_id']);
    }

    /**
     * {@inheritdoc}
     * @return AlunoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AlunoQuery(get_called_class());
    }
}
