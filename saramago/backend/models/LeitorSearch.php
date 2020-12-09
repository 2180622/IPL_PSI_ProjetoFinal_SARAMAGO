<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Leitor;

/**
 * LeitorSearch represents the model behind the search form of `common\models\Leitor`.
 */
class LeitorSearch extends Leitor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nif', 'codPostal', 'telemovel', 'telefone', 'Biblioteca_id', 'TipoLeitor_id', 'user_id'], 'integer'],
            [['codBarras', 'nome', 'docId', 'dataNasc', 'morada', 'localidade', 'mail2', 'notaInterna', 'dataRegisto', 'dataAtualizado'], 'safe'],
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
        $query = Leitor::find();

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
            'nif' => $this->nif,
            'codBarras' => $this->codBarras,
            'dataNasc' => $this->dataNasc,
            'codPostal' => $this->codPostal,
            'telemovel' => $this->telemovel,
            'telefone' => $this->telefone,
            'dataRegisto' => $this->dataRegisto,
            'dataAtualizado' => $this->dataAtualizado,
            'Biblioteca_id' => $this->Biblioteca_id,
            'TipoLeitor_id' => $this->TipoLeitor_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'codBarras', $this->codBarras])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'docId', $this->docId])
            ->andFilterWhere(['like', 'morada', $this->morada])
            ->andFilterWhere(['like', 'localidade', $this->localidade])
            ->andFilterWhere(['like', 'mail2', $this->mail2])
            ->andFilterWhere(['like', 'notaInterna', $this->notaInterna]);

        return $dataProvider;
    }
}
