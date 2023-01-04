<?php

namespace app\models;

use yii\db\ActiveRecord;

use app\models\LatestDateUpdater;

/**
 * Сlass for interacting with the "currency" table of the database
 *
 *  The "currency" table stores data on all currencies:
 *  their name, symbolic code, number code, exchange rate against the ruble.
 *  With this class, we can get and update this data,
 *  as well as record the date the data was last modified.
 */
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

    /**
     * This method looks for currency codes
     *
     * @static
     * @return array codes of currencies available for conversion
     */
    public static function getСurrencyCharCodes()
    {
        return self::find()->select(['CharCode'])->indexBy('CharCode')->column();
    }

    /**
     * Getting the latest update/change time of the "currency" table
     *
     * @static
     * @return date
     */
    public static function getLatestUpdateDate()
    {
        return LatestDateUpdater::getLatestUpdateDate(self::getTableSchema()->fullName);
    }

    /**
     * Setting the latest update/change time of the "currency" table
     *
     * @static
     * @param date $newDate new update date(usually the current date)
     */
    public static function setLatestUpdateDate($newDate)
    {
        LatestDateUpdater::setLatestUpdateDate(self::getTableSchema()->fullName, $newDate);
    }
}
