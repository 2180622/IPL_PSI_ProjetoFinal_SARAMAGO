<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Biblioteca;

/**
 * BibliotecaSearch represents the model behind the search form of `common\models\Biblioteca`.
 */
class BibliotecaSearch extends Biblioteca
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'codPostal', 'levantamento'], 'integer'],
            [['codBiblioteca', 'nome', 'notasOpac', 'morada', 'localidade'], 'safe'],
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
        $query = Biblioteca::find();

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
            'codPostal' => $this->codPostal,
            'levantamento' => $this->levantamento,
        ]);

        $query->andFilterWhere(['like', 'codBiblioteca', $this->codBiblioteca])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'notasOpac', $this->notasOpac])
            ->andFilterWhere(['like', 'morada', $this->morada])
            ->andFilterWhere(['like', 'localidade', $this->localidade]);

        return $dataProvider;
    }
}

