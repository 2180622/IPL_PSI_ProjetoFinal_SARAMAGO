<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "postotrabalho".
 *
 * @property int $id Chave primária
 * @property string $designacao Designação do Posto de Trabalho
 * @property int $totalLugares Total de lugares
 * @property string|null $notaOpac Informação para o OPAC
 * @property string|null $notaInterna Informação interna
 *
 * @property Reservasposto[] $reservaspostos
 */
class Postotrabalho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'postotrabalho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designacao', 'totalLugares'], 'required'],
            [['totalLugares'], 'integer'],
            [['designacao', 'notaOpac'], 'string', 'max' => 255],
            [['notaInterna'], 'string', 'max' => 2555],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'designacao' => 'Designação do Posto de Trabalho',
            'totalLugares' => 'Total de lugares',
            'notaOpac' => 'Informação para o OPAC',
            'notaInterna' => 'Informação interna',
        ];
    }

    /**
     * Gets query for [[Reservaspostos]].
     *
     * @return \yii\db\ActiveQuery|ReservaspostoQuery
     */
    public function getReservaspostos()
    {
        return $this->hasMany(Reservasposto::className(), ['PostoTrabalho_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PostotrabalhoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostotrabalhoQuery(get_called_class());
    }
}
