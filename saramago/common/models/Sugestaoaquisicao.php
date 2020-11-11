<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sugestaoaquisicao".
 *
 * @property int $id Chave primária
 * @property int $Leitor_id Chave estrangeira
 * @property int $Obra_id Chave estrangeira
 *
 * @property Leitor $leitor
 * @property Obra $obra
 */
class Sugestaoaquisicao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sugestaoaquisicao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Leitor_id', 'Obra_id'], 'required'],
            [['Leitor_id', 'Obra_id'], 'integer'],
            [['Leitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leitor::className(), 'targetAttribute' => ['Leitor_id' => 'id']],
            [['Obra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'Leitor_id' => 'Chave estrangeira',
            'Obra_id' => 'Chave estrangeira',
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
     * Gets query for [[Obra]].
     *
     * @return \yii\db\ActiveQuery|ObraQuery
     */
    public function getObra()
    {
        return $this->hasOne(Obra::className(), ['id' => 'Obra_id']);
    }

    /**
     * {@inheritdoc}
     * @return SugestaoaquisicaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SugestaoaquisicaoQuery(get_called_class());
    }
}
