<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Obra;

/**
 * ObraSearch represents the model behind the search form of `common\models\obra`.
 */
class ObraSearch extends Obra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Cdu_id', 'Colecao_id'], 'integer'],
            [['imgCapa', 'titulo', 'resumo', 'editor', 'ano', 'tipoObra', 'descricao', 'local', 'edicao', 'assuntos', 'dataRegisto', 'dataAtualizado'], 'safe'],
            [['preco'], 'number'],
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
        $query = obra::find();

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
            'ano' => $this->ano,
            'preco' => $this->preco,
            'dataRegisto' => $this->dataRegisto,
            'dataAtualizado' => $this->dataAtualizado,
            'Cdu_id' => $this->Cdu_id,
            'Colecao_id' => $this->Colecao_id,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'resumo', $this->resumo])
            ->andFilterWhere(['like', 'editor', $this->editor])
            ->andFilterWhere(['like', 'tipoObra', $this->tipoObra])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'edicao', $this->edicao])
            ->andFilterWhere(['like', 'assuntos', $this->assuntos]);

        return $dataProvider;
    }
}
