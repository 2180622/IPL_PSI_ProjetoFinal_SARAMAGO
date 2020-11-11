<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservasposto".
 *
 * @property int $id Chave primária
 * @property string $dataPedido Data do pedido
 * @property string $dataReserva Data para reserva
 * @property int $lugar Lugar referente
 * @property string|null $notaOpac Nota do Opac
 * @property string|null $notaInterna Nota interna
 * @property string|null $estadoReserva Estado referente a reserva
 * @property string $operador
 * @property int $Leitor_id Chave estrangeira
 * @property int $PostoTrabalho_id Chave estrangeira
 *
 * @property Leitor $leitor
 * @property Postotrabalho $postoTrabalho
 */
class Reservasposto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservasposto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataPedido', 'dataReserva'], 'safe'],
            [['dataReserva', 'lugar', 'operador', 'Leitor_id', 'PostoTrabalho_id'], 'required'],
            [['lugar', 'Leitor_id', 'PostoTrabalho_id'], 'integer'],
            [['notaOpac', 'notaInterna', 'estadoReserva'], 'string'],
            [['operador'], 'string', 'max' => 255],
            [['Leitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leitor::className(), 'targetAttribute' => ['Leitor_id' => 'id']],
            [['PostoTrabalho_id'], 'exist', 'skipOnError' => true, 'targetClass' => Postotrabalho::className(), 'targetAttribute' => ['PostoTrabalho_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'dataPedido' => 'Data do pedido',
            'dataReserva' => 'Data para reserva',
            'lugar' => 'Lugar referente',
            'notaOpac' => 'Nota do Opac',
            'notaInterna' => 'Nota interna',
            'estadoReserva' => 'Estado referente a reserva',
            'operador' => 'Operador',
            'Leitor_id' => 'Chave estrangeira',
            'PostoTrabalho_id' => 'Chave estrangeira',
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
     * Gets query for [[PostoTrabalho]].
     *
     * @return \yii\db\ActiveQuery|PostotrabalhoQuery
     */
    public function getPostoTrabalho()
    {
        return $this->hasOne(Postotrabalho::className(), ['id' => 'PostoTrabalho_id']);
    }

    /**
     * {@inheritdoc}
     * @return ReservaspostoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReservaspostoQuery(get_called_class());
    }
}
