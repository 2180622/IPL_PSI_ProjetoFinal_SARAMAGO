<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "leiturarecomendada".
 *
 * @property int $id Chave primária
 * @property string $dataInicial Data de inicio
 * @property string|null $dataFinal Data de termino
 * @property int $Funcionario_id Chave estrangeira
 * @property int $Uc_id Chave estrangeira
 * @property int $Obra_id
 *
 * @property Funcionario $funcionario
 * @property Obra $obra
 * @property Uc $uc
 */
class Leiturarecomendada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leiturarecomendada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataInicial', 'Funcionario_id', 'Uc_id', 'Obra_id'], 'required'],
            [['dataInicial', 'dataFinal'], 'safe'],
            [['Funcionario_id', 'Uc_id', 'Obra_id'], 'integer'],
            [['Funcionario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::className(), 'targetAttribute' => ['Funcionario_id' => 'id']],
            [['Obra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
            [['Uc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Uc::className(), 'targetAttribute' => ['Uc_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'dataInicial' => 'Data de inicio',
            'dataFinal' => 'Data de termino',
            'Funcionario_id' => 'Chave estrangeira',
            'Uc_id' => 'Chave estrangeira',
            'Obra_id' => 'Obra ID',
        ];
    }

    /**
     * Gets query for [[Funcionario]].
     *
     * @return \yii\db\ActiveQuery|FuncionarioQuery
     */
    public function getFuncionario()
    {
        return $this->hasOne(Funcionario::className(), ['id' => 'Funcionario_id']);
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
     * @return LeiturarecomendadaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LeiturarecomendadaQuery(get_called_class());
    }
}
