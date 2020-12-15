<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reprografia;

/**
 * ReprografiaSearch represents the model behind the search form of `common\models\Reprografia`.
 */
class ReprografiaSearch extends Reprografia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'copias', 'frenteVerso', 'Leitor_id', 'Obra_id'], 'integer'],
            [['dataPedido', 'dataConcluido', 'paginas', 'cor', 'estado', 'notaOpac', 'notaInterna', 'operador'], 'safe'],
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
        $query = Reprografia::find();

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
            'dataConcluido' => $this->dataConcluido,
            'copias' => $this->copias,
            'frenteVerso' => $this->frenteVerso,
            'Leitor_id' => $this->Leitor_id,
            'Obra_id' => $this->Obra_id,
        ]);

        $query->andFilterWhere(['like', 'paginas', $this->paginas])
            ->andFilterWhere(['like', 'cor', $this->cor])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'notaOpac', $this->notaOpac])
            ->andFilterWhere(['like', 'notaInterna', $this->notaInterna])
            ->andFilterWhere(['like', 'operador', $this->operador]);

        return $dataProvider;
    }
}
