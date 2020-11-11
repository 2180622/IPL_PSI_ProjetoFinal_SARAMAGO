<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "requisicao_exemplar".
 *
 * @property int $Requisicao_id
 * @property int $Exemplar_id
 *
 * @property Exemplar $exemplar
 * @property Requisicao $requisicao
 */
class RequisicaoExemplar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisicao_exemplar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Requisicao_id', 'Exemplar_id'], 'required'],
            [['Requisicao_id', 'Exemplar_id'], 'integer'],
            [['Requisicao_id', 'Exemplar_id'], 'unique', 'targetAttribute' => ['Requisicao_id', 'Exemplar_id']],
            [['Exemplar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exemplar::className(), 'targetAttribute' => ['Exemplar_id' => 'id']],
            [['Requisicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requisicao::className(), 'targetAttribute' => ['Requisicao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Requisicao_id' => 'Requisicao ID',
            'Exemplar_id' => 'Exemplar ID',
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
     * Gets query for [[Requisicao]].
     *
     * @return \yii\db\ActiveQuery|RequisicaoQuery
     */
    public function getRequisicao()
    {
        return $this->hasOne(Requisicao::className(), ['id' => 'Requisicao_id']);
    }

    /**
     * {@inheritdoc}
     * @return RequisicaoExemplarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequisicaoExemplarQuery(get_called_class());
    }
}
