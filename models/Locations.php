<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $location_id
 * @property string|null $street_address
 * @property string|null $postal_code
 * @property string $city
 * @property string|null $state_province
 * @property string $country_id
 *
 * @property Departments[] $departments
 * @property Countries $country
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'country_id'], 'required'],
            [['street_address'], 'string', 'max' => 40],
            [['postal_code'], 'string', 'max' => 12],
            [['city'], 'string', 'max' => 30],
            [['state_province'], 'string', 'max' => 25],
            [['country_id'], 'string', 'max' => 2],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'country_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'street_address' => 'Street Address',
            'postal_code' => 'Postal Code',
            'city' => 'City',
            'state_province' => 'State Province',
            'country_id' => 'Country ID',
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['location_id' => 'location_id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['country_id' => 'country_id']);
    }
}
