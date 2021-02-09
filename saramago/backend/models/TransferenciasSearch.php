<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Exemplar;

/**
 * ExemplarSearch represents the model behind the search form of `common\models\Exemplar`.
 */
class TransferenciasSearch extends Exemplar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'suplemento', 'Biblioteca_id', 'EstatutoExemplar_id', 'TipoExemplar_id', 'Obra_id', 'Fundo_id'], 'integer'],
            [['cota', 'codBarras', 'estado', 'notaInterna'], 'safe'],
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
        $query = Exemplar::find()->where(['estado'=>self::ESTADO_TRANSFERENCIA]);

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
            'suplemento' => $this->suplemento,
            'Biblioteca_id' => $this->Biblioteca_id,
            'EstatutoExemplar_id' => $this->EstatutoExemplar_id,
            'TipoExemplar_id' => $this->TipoExemplar_id,
            'Obra_id' => $this->Obra_id,
            'Fundo_id' => $this->Fundo_id,
        ]);

        $query->andFilterWhere(['like', 'cota', $this->cota])
            ->andFilterWhere(['like', 'codBarras', $this->codBarras])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'notaInterna', $this->notaInterna]);

        return $dataProvider;
    }
}