<?php

namespace app\models;

use yii\db\ActiveRecord;

use app\models\LatestDateUpdater;

class Currency extends ActiveRecord
{	
    public function rules()
    {
        return [
            [['NumCode', 'CharCode', 'Name', 'Nominal', 'Value'], 'required'],
        ];
    }

    public static function tableName()
    {
        return '{{%currency}}';
    }

    public static function getСurrencyCharCodes()
    {
        return self::find()->select(['CharCode'])->indexBy('CharCode')->column();
    }

    public static function getLatestUpdateDate()
    {
        LatestDateUpdater::getLatestUpdateDate(self::getTableSchema()->fullName);
    }

    public static function setLatestUpdateDate($newDate)
    {
        LatestDateUpdater::setLatestUpdateDate(self::getTableSchema()->fullName, $newDate);
    }
}
