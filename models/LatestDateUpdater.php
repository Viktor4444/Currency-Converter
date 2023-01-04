<?php

namespace app\models;

use yii\db\ActiveRecord;

class LatestDateUpdater extends ActiveRecord
{	
    public function rules()
    {
        return [
            [['TableName'], 'required'],
        ];
    }

    public static function tableName()
    {
        return '{{%LatestTablesUpdateDate}}';
    }

    public static function getLatestUpdateDate($tableName)
    {
        return static::findOne(['TableName' => $tableName])->LatestUpdate;
    }

    public static function setLatestUpdateDate($tableName, $newDate=null)
    {
        if (!$newDate){
            $newDate = date("Y-m-d");
        }
        $latestUpdateDateTable = static::findOne(['TableName' => $tableName]);
        $latestUpdateDateTable->LatestUpdate = $newDate;
        $latestUpdateDateTable->save();
    }
}
