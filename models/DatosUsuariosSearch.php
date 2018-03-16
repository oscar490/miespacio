<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DatosUsuarios;

/**
 * DatosUsuariosSearch represents the model behind the search form of `app\models\DatosUsuarios`.
 */
class DatosUsuariosSearch extends DatosUsuarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id'], 'integer'],
            [['nombre_completo', 'descripcion', 'registro', 'ultimo_acceso', 'iniciales'], 'safe'],
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
        $query = DatosUsuarios::find();

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
            'usuario_id' => $this->usuario_id,
        ]);

        $query->andFilterWhere(['ilike', 'nombre_completo', $this->nombre_completo])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'iniciales', $this->iniciales]);

        return $dataProvider;
    }
}
