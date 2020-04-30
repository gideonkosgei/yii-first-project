<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job_history".
 *
 * @property int $employee_id
 * @property string $start_date
 * @property string $end_date
 * @property string $job_id
 * @property int $department_id
 *
 * @property Employees $employee
 * @property Jobs $job
 * @property Departments $department
 */
class JobHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'start_date', 'end_date', 'job_id', 'department_id'], 'required'],
            [['employee_id', 'department_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['job_id'], 'string', 'max' => 10],
            [['employee_id', 'start_date'], 'unique', 'targetAttribute' => ['employee_id', 'start_date']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::className(), 'targetAttribute' => ['job_id' => 'job_id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'department_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'job_id' => 'Job ID',
            'department_id' => 'Department ID',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobs::className(), ['job_id' => 'job_id']);
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['department_id' => 'department_id']);
    }
}
