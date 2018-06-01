<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mensajes;

/**
 * MensajesSearch represents the model behind the search form of `app\models\Mensajes`.
 */
class MensajesSearch extends Mensajes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'emisor', 'receptor'], 'integer'],
            [['asunto', 'contenido', 'created_at', 'view_at'], 'safe'],
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
        $query = Mensajes::find();

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
            'emisor' => $this->emisor,
            'receptor' => $this->receptor,
            'created_at' => $this->created_at,
            'view_at' => $this->view_at,
        ]);

        $query->andFilterWhere(['ilike', 'asunto', $this->asunto])
            ->andFilterWhere(['ilike', 'contenido', $this->contenido]);

        return $dataProvider;
    }
}
