<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Сlass for interacting with the "LatestTablesUpdateDate" table of the database
 *
 * The "LatestTablesUpdateDate" table contains data about when any changes or updates
 * were made to all tables in the database.
 * This class allows you to track and modify the corresponding data.
 */
class LatestDateUpdater extends ActiveRecord
{	
    public function rules()
    {
        return [
            [['table_name'], 'required'],
        ];
    }

    public static function tableName()
    {
        return '{{%latest_tables_update_date}}';
    }

    /**
     * This method returns the latest update date of the table by its name
     *
     * @static
     * @param  str $tableName table name in database
     * @return data            date the table was last updated
     */
    public static function getLatestUpdateDate($tableName)
    {
        return static::findOne(['table_name' => $tableName])->latest_update;
    }

    /**
     * This method updates the last modified date of the table
     *
     * @static
     * @param str $tableName the name of the table in which the changes were made
     * @param [type] $newDate   date of the change. if no parameter is passed, sets the current date
     */
    public static function setLatestUpdateDate($tableName, $newDate=null)
    {
        if (!$newDate){
            $newDate = date("Y-m-d");
        }
        $latestUpdateDateTable = static::findOne(['table_name' => $tableName]);
        $latestUpdateDateTable->latest_update = $newDate;
        $latestUpdateDateTable->save();
    }
}
