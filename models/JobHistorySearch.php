<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobHistory;

/**
 * JobHistorySearch represents the model behind the search form of `app\models\JobHistory`.
 */
class JobHistorySearch extends JobHistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'department_id'], 'integer'],
            [['start_date', 'end_date', 'job_id'], 'safe'],
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
        $query = JobHistory::find();

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
            'employee_id' => $this->employee_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'department_id' => $this->department_id,
        ]);

        $query->andFilterWhere(['like', 'job_id', $this->job_id]);

        return $dataProvider;
    }
}
