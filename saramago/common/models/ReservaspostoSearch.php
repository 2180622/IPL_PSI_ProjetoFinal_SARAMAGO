<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reservasposto;

/**
 * ReservaspostoSearch represents the model behind the search form of `common\models\Reservasposto`.
 */
class ReservaspostoSearch extends Reservasposto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lugar', 'Leitor_id', 'PostoTrabalho_id'], 'integer'],
            [['dataPedido', 'dataReserva', 'notaOpac', 'notaInterna', 'estadoReserva', 'operador'], 'safe'],
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
        $query = Reservasposto::find();

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
            'dataPedido' => $this->dataPedido,
            'dataReserva' => $this->dataReserva,
            'lugar' => $this->lugar,
            'Leitor_id' => $this->Leitor_id,
            'PostoTrabalho_id' => $this->PostoTrabalho_id,
        ]);

        $query->andFilterWhere(['like', 'notaOpac', $this->notaOpac])
            ->andFilterWhere(['like', 'notaInterna', $this->notaInterna])
            ->andFilterWhere(['like', 'estadoReserva', $this->estadoReserva])
            ->andFilterWhere(['like', 'operador', $this->operador]);

        return $dataProvider;
    }
}
