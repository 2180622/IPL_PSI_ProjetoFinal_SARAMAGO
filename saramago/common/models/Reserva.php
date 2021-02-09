<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reserva".
 *
 * @property int $id Chave primária
 * @property string|null $dataReserva Data da reserva
 * @property string|null $estadoReserva Estado da reserva
 * @property string|null $dataFecho Data de fecho
 * @property string|null $notaReserva Nota da reserva
 * @property int $Leitor_id Chave estrangeiro
 * @property int $Exemplar_id Chave estrangeiro
 *
 * @property Exemplar $exemplar
 * @property Leitor $leitor
 */
class Reserva extends \yii\db\ActiveRecord
{
    const ESTADO_RESERVADO = 'reservado';
    const ESTADO_CANCELADO = 'cancelado';
    const ESTADO_CONCLUIDO = 'concluido';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataReserva', 'dataFecho'], 'safe'],
            [['estadoReserva', 'notaReserva'], 'string'],
            [['Leitor_id', 'Exemplar_id'], 'required'],
            [['Leitor_id', 'Exemplar_id'], 'integer'],
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
            'dataReserva' => 'Data da reserva',
            'estadoReserva' => 'Estado da reserva',
            'dataFecho' => 'Data de fecho',
            'notaReserva' => 'Nota da reserva',
            'Leitor_id' => 'Chave estrangeiro',
            'Exemplar_id' => 'Chave estrangeiro',
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
     * @return ReservaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReservaQuery(get_called_class());
    }
}
