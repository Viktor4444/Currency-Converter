<?php

namespace app\models;

use yii\db\ActiveRecord;

class Currency extends ActiveRecord
{	
    public function rules()
    {
        return [
            [['CharCode', 'Name', 'Nominal', 'Value', 'NumCode'], 'required'],
        ];
    }

    public static function getСurrencyCharCodes()
    {
        return self::find()->select(['CharCode'])->indexBy('CharCode')->column();
    }

    public static function getLatestUpdateDate()
    {
        return self::find()->one()->dt;
    }
}
