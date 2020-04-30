<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property string $job_id
 * @property string $job_title
 * @property float|null $min_salary
 * @property float|null $max_salary
 *
 * @property Employees[] $employees
 * @property JobHistory[] $jobHistories
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'job_title'], 'required'],
            [['min_salary', 'max_salary'], 'number'],
            [['job_id'], 'string', 'max' => 10],
            [['job_title'], 'string', 'max' => 35],
            [['job_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'job_id' => 'Job ID',
            'job_title' => 'Job Title',
            'min_salary' => 'Min Salary',
            'max_salary' => 'Max Salary',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['job_id' => 'job_id']);
    }

    /**
     * Gets query for [[JobHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobHistories()
    {
        return $this->hasMany(JobHistory::className(), ['job_id' => 'job_id']);
    }
}
