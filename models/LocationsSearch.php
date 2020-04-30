<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Locations;

/**
 * LocationsSearch represents the model behind the search form of `app\models\Locations`.
 */
class LocationsSearch extends Locations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location_id'], 'integer'],
            [['street_address', 'postal_code', 'city', 'state_province', 'country_id'], 'safe'],
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
        $query = Locations::find();

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
            'location_id' => $this->location_id,
        ]);

        $query->andFilterWhere(['like', 'street_address', $this->street_address])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state_province', $this->state_province])
            ->andFilterWhere(['like', 'country_id', $this->country_id]);

        return $dataProvider;
    }
}
