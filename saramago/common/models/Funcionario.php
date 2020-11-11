<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "funcionario".
 *
 * @property int $id Chave primária
 * @property string|null $departamento Departamento do funcionário
 * @property int $Leitor_id Chave estrangeira
 *
 * @property Leitor $leitor
 * @property Leiturarecomendada[] $leiturarecomendadas
 */
class Funcionario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funcionario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Leitor_id'], 'required'],
            [['Leitor_id'], 'integer'],
            [['departamento'], 'string', 'max' => 255],
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
            'departamento' => 'Departamento do funcionário',
            'Leitor_id' => 'Chave estrangeira',
        ];
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
     * Gets query for [[Leiturarecomendadas]].
     *
     * @return \yii\db\ActiveQuery|LeiturarecomendadaQuery
     */
    public function getLeiturarecomendadas()
    {
        return $this->hasMany(Leiturarecomendada::className(), ['Funcionario_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FuncionarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FuncionarioQuery(get_called_class());
    }
}
