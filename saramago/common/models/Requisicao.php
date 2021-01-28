<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "requisicao".
 *
 * @property int $id Chave primária
 * @property string $dataEmprestimo Data de empréstimo
 * @property string $entregaPrevista Data prevista para entrega
 * @property string|null $dataDevolucao Data de devolução
 * @property int $Renovacoes Renovações realizadas
 * @property int $Leitor_id
 * @property int $Exemplar_id
 *
 * @property Exemplar $exemplar
 * @property Leitor $leitor
 */
class Requisicao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisicao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataEmprestimo', 'entregaPrevista', 'dataDevolucao'], 'safe'],
            [['entregaPrevista', 'Leitor_id', 'Exemplar_id'], 'required'],
            [['Renovacoes', 'Leitor_id', 'Exemplar_id'], 'integer'],
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
            'dataEmprestimo' => 'Data de empréstimo',
            'entregaPrevista' => 'Data prevista para entrega',
            'dataDevolucao' => 'Data de devolução',
            'Renovacoes' => 'Renovações realizadas',
            'Leitor_id' => 'Leitor ID',
            'Exemplar_id' => 'Exemplar ID',
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
     * Gets query for [[Exemplar]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplar()
    {
        return $this->hasOne(Exemplar::className(), ['id' => 'Exemplar_id']);
    }

    /**
     * Gets query for [[Exemplars]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplars()
    {
        return $this->hasMany(Exemplar::className(), ['id' => 'Exemplar_id'])->viaTable('requisicao_exemplar', ['Requisicao_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RequisicaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequisicaoQuery(get_called_class());
    }
}
