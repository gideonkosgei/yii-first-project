<?php

namespace app\models;
use Yii;
class Regions extends \yii\db\ActiveRecord
{   
    public static function tableName()
    {
        return 'regions';
    }
    
    public function rules()
    {
        return [
            #[['region_id'], 'required'],
            [['region_id'], 'integer'],
            [['region_name'], 'string', 'max' => 25],
            [['region_id'], 'unique'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'region_name' => 'Region Name',
        ];
    }
   
    public function getCountries()
    {
        return $this->hasMany(Countries::className(), ['region_id' => 'region_id']);
    }
}
