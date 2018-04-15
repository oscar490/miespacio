<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subidas;

/**
 * SubidasSearch represents the model behind the search form of `app\models\Subidas`.
 */
class SubidasSearch extends Subidas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'adjunto_id', 'tarjeta_id'], 'integer'],
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
        $query = Subidas::find();

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
            'adjunto_id' => $this->adjunto_id,
            'tarjeta_id' => $this->tarjeta_id,
        ]);

        return $dataProvider;
    }
}
