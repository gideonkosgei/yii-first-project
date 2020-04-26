<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $mobile
 * @property string|null $address
 * @property int|null $age
 */
class Person extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'person';
    }

    
    public function rules()
    {
        return [
            [['age'], 'integer'],
            [['firstname', 'lastname', 'mobile', 'address'], 'string', 'max' => 255],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'age' => 'Age',
        ];
    }
}
