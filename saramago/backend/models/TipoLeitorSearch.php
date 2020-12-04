<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TipoLeitor;

/**
 * TipoLeitorSearch represents the model behind the search form of `common\models\TipoLeitor`.
 */
class TipoLeitorSearch extends TipoLeitor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nItens', 'prazoDias', 'registoOpac'], 'integer'],
            [['estatuto', 'tipo', 'notas'], 'safe'],
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
        $query = TipoLeitor::find();

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
            'nItens' => $this->nItens,
            'prazoDias' => $this->prazoDias,
            'registoOpac' => $this->registoOpac,
        ]);

        $query->andFilterWhere(['like', 'estatuto', $this->estatuto])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'notas', $this->notas]);

        return $dataProvider;
    }
}