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
 *
 * @internal Important note: this class uses database column and table descriptions
 *  whose names use snake case,
 *  so the style of variable names in the code may differ
 *
 * @property integer $num_code
 * @property string $char_code
 * @property string $name
 * @property float $nominal
 * @property float $value
 */
class Currency extends ActiveRecord
{
    /**
     * {@inheritdoc}
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // num_code, char_code, name, nominal and value are required
            [['num_code', 'char_code', 'name', 'nominal', 'value'], 'required'],
            // num_code must be a numeric value
            ['num_code', 'number'],
            // value and nominal must be a numeric real value
            [['value', 'nominal'], 'filter', 'filter' => function($value){
                $value = str_replace(',', '.', $value);
                return floatval($value);
            }],
        ];
    }

    /**
     * {@inheritdoc}
     * @static
     * @return string name of table in database
     */
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
        return self::find()->select(['char_code'])->indexBy('char_code')->column();
    }

    /**
     * @static
     * @see LatestDateUpdater::$getLatestUpdateDate
     * @return string
     */
    public static function getLatestUpdateDate()
    {
        return LatestDateUpdater::getLatestUpdateDate(self::getTableSchema()->fullName);
    }

    /**
     * @static
     * @see LatestDateUpdater::$setLatestUpdateDate
     * @param string $newDate new update date(usually the current date)
     */
    public static function setLatestUpdateDate($newDate)
    {
        LatestDateUpdater::setLatestUpdateDate(self::getTableSchema()->fullName, $newDate);
    }
}
