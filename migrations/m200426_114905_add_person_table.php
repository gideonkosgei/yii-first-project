<?php

use yii\db\Schema;
use yii\db\Migration;


class m200426_114905_add_person_table extends Migration
{
  
    public function safeUp()
    {
        $this->createTable("person", [
            "id" => Schema::TYPE_PK,
            "firstname" => Schema::TYPE_STRING,
            "lastname" => Schema::TYPE_STRING,
            "mobile" => Schema::TYPE_STRING,
            "address" => Schema::TYPE_STRING,
            "age" => Schema::TYPE_INTEGER
            
         ]);
    }

   
    public function safeDown()
    {
        $this->dropTable("person");
    }

    
}
