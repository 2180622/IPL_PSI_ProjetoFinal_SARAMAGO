<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ConsultaTReal;

/**
 * ConsultaTRealSearch represents the model behind the search form of `common\models\ConsultaTReal`.
 */
class ConsultaTRealSearch extends ConsultaTReal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Leitor_id', 'Exemplar_id'], 'integer'],
            [['dataHoraInicial', 'dataHoraFinal', 'operador'], 'safe'],
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
        $query = ConsultaTReal::find();

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
            //'dataHoraInicial' => $this->dataHoraInicial,
            //'dataHoraFinal' => $this->dataHoraFinal,
            'Leitor_id' => $this->Leitor_id,
            'Exemplar_id' => $this->Exemplar_id,
        ]);

        $query->andFilterWhere(['like', 'operador', $this->operador]);
        $query->andFilterWhere(['like', 'dataHoraInicial', $this->dataHoraInicial]);
        $query->andFilterWhere(['like', 'dataHoraFinal', $this->dataHoraFinal]);

        return $dataProvider;
    }

    public function afterFind()
    {
        $this->$this->dataHoraInicial = \Yii::$app->formatter->asDatetime($this->dataHoraInicial);
    }
}
