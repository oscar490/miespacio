<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Listas;

/**
 * ListasSearch represents the model behind the search form of `app\models\Listas`.
 */
class ListasSearch extends Listas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tablero_id'], 'integer'],
            [['denominacion'], 'safe'],
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
        $query = Listas::find();

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
            'tablero_id' => $this->tablero_id,
        ]);

        $query->andFilterWhere(['ilike', 'denominacion', $this->denominacion]);

        return $dataProvider;
    }
}
