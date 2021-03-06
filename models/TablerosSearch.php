<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tableros;

/**
 * TablerosSearch represents the model behind the search form of `app\models\Tableros`.
 */
class TablerosSearch extends Tableros
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'equipo_id'], 'integer'],
            [['denominacion'], 'default'],
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
        $query = Tableros::find()
            ->from('tableros t')
            ->joinWith('equipo e')
            ->joinWith('miembros m')
            ->where([
                'm.usuario_id'=>Yii::$app->user->id,
            ]);



        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        $this->load($params);


        if ($this->denominacion === null) {

            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'equipo_id' => $this->equipo_id,
        // ]);

        $query->andFilterWhere(['ilike', 't.denominacion', $this->denominacion]);

        
        return $dataProvider;
    }
}
