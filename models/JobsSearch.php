<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jobs;

/**
 * JobsSearch represents the model behind the search form of `app\models\Jobs`.
 */
class JobsSearch extends Jobs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'job_title'], 'safe'],
            [['min_salary', 'max_salary'], 'number'],
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
        $query = Jobs::find();

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
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
        ]);

        $query->andFilterWhere(['like', 'job_id', $this->job_id])
            ->andFilterWhere(['like', 'job_title', $this->job_title]);

        return $dataProvider;
    }
}
