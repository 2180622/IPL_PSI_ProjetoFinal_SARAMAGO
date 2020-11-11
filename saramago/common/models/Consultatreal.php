<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "consultatreal".
 *
 * @property int $id Chave primária
 * @property string $dataHoraInicial Data e hora inicial
 * @property string|null $dataHoraFinal Data e hora de término
 * @property string $operador Operador
 * @property int $Leitor_id Chave estrangeira
 * @property int $Exemplar_id Chave estrangeira
 *
 * @property Exemplar $exemplar
 * @property Leitor $leitor
 */
class Consultatreal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consultatreal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataHoraInicial', 'dataHoraFinal'], 'safe'],
            [['operador', 'Leitor_id', 'Exemplar_id'], 'required'],
            [['Leitor_id', 'Exemplar_id'], 'integer'],
            [['operador'], 'string', 'max' => 255],
            [['Exemplar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exemplar::className(), 'targetAttribute' => ['Exemplar_id' => 'id']],
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
            'dataHoraInicial' => 'Data e hora inicial',
            'dataHoraFinal' => 'Data e hora de término',
            'operador' => 'Operador',
            'Leitor_id' => 'Chave estrangeira',
            'Exemplar_id' => 'Chave estrangeira',
        ];
    }

    /**
     * Gets query for [[Exemplar]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplar()
    {
        return $this->hasOne(Exemplar::className(), ['id' => 'Exemplar_id']);
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
     * @return ConsultatrealQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConsultatrealQuery(get_called_class());
    }
}
