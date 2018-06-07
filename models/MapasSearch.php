<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mapas;

/**
 * MapasSearch represents the model behind the search form of `app\models\Mapas`.
 */
class MapasSearch extends Mapas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'latitud', 'longitud', 'tarjeta_id'], 'integer'],
            [['ubicacion'], 'safe'],
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
        $query = Mapas::find();

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
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'tarjeta_id' => $this->tarjeta_id,
        ]);

        $query->andFilterWhere(['ilike', 'ubicacion', $this->ubicacion]);

        return $dataProvider;
    }
}
