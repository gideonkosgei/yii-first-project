<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $department_id
 * @property string $department_name
 * @property int|null $manager_id
 * @property int|null $location_id
 *
 * @property Locations $location
 * @property Employees $manager
 * @property Employees[] $employees
 * @property JobHistory[] $jobHistories
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_name'], 'required'],
            [['manager_id', 'location_id'], 'integer'],
            [['department_name'], 'string', 'max' => 30],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'location_id']],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['manager_id' => 'employee_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'manager_id' => 'Manager ID',
            'location_id' => 'Location ID',
        ];
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['location_id' => 'location_id']);
    }

    /**
     * Gets query for [[Manager]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Employees::className(), ['employee_id' => 'manager_id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['department_id' => 'department_id']);
    }

    /**
     * Gets query for [[JobHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobHistories()
    {
        return $this->hasMany(JobHistory::className(), ['department_id' => 'department_id']);
    }
}
