<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property string $country_id
 * @property string|null $country_name
 * @property int $region_id
 *
 * @property Regions $region
 * @property Locations[] $locations
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'region_id'], 'required'],
            [['region_id'], 'integer'],
            [['country_id'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 40],
            [['country_id'], 'unique'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['region_id' => 'region_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'country_name' => 'Country Name',
            'region_id' => 'Region ID',
        ];
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['region_id' => 'region_id']);
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Locations::className(), ['country_id' => 'country_id']);
    }
}
