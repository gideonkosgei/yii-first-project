<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $employee_id
 * @property string|null $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone_number
 * @property string $hire_date
 * @property string $job_id
 * @property float $salary
 * @property float|null $commission_pct
 * @property int|null $manager_id
 * @property int|null $department_id
 *
 * @property Departments[] $departments
 * @property Jobs $job
 * @property Departments $department
 * @property Employees $manager
 * @property Employees[] $employees
 * @property JobHistory[] $jobHistories
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_name', 'email', 'hire_date', 'job_id', 'salary'], 'required'],
            [['hire_date'], 'safe'],
            [['salary', 'commission_pct'], 'number'],
            [['manager_id', 'department_id'], 'integer'],
            [['first_name', 'phone_number'], 'string', 'max' => 20],
            [['last_name', 'email'], 'string', 'max' => 25],
            [['job_id'], 'string', 'max' => 10],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::className(), 'targetAttribute' => ['job_id' => 'job_id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'department_id']],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['manager_id' => 'employee_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'hire_date' => 'Hire Date',
            'job_id' => 'Job ID',
            'salary' => 'Salary',
            'commission_pct' => 'Commission Pct',
            'manager_id' => 'Manager ID',
            'department_id' => 'Department ID',
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['manager_id' => 'employee_id']);
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
        return $this->hasMany(Employees::className(), ['manager_id' => 'employee_id']);
    }

    /**
     * Gets query for [[JobHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobHistories()
    {
        return $this->hasMany(JobHistory::className(), ['employee_id' => 'employee_id']);
    }
}
