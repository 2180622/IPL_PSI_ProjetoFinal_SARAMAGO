<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Requisicao;

/**
 * RequisicaoLeitorSearch represents the model behind the search form of `common\models\Requisicao`.
 */
class LeitorRequisicaoSearch extends Requisicao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Renovacoes', 'Leitor_id', 'Exemplar_id'], 'integer'],
            [['dataEmprestimo', 'entregaPrevista', 'dataDevolucao'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Requisicao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dataEmprestimo' => $this->dataEmprestimo,
            'entregaPrevista' => $this->entregaPrevista,
            'dataDevolucao' => $this->dataDevolucao,
            'Renovacoes' => $this->Renovacoes,
            'Leitor_id' => $this->Leitor_id,
            'Exemplar_id' => $this->Exemplar_id,
        ]);

        return $dataProvider;
    }
}