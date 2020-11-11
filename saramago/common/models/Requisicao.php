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
 *
 * @property Leitor $leitor
 * @property RequisicaoExemplar[] $requisicaoExemplars
 * @property Exemplar[] $exemplars
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
            [['entregaPrevista', 'Leitor_id'], 'required'],
            [['Renovacoes', 'Leitor_id'], 'integer'],
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
     * Gets query for [[RequisicaoExemplars]].
     *
     * @return \yii\db\ActiveQuery|RequisicaoExemplarQuery
     */
    public function getRequisicaoExemplars()
    {
        return $this->hasMany(RequisicaoExemplar::className(), ['Requisicao_id' => 'id']);
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
