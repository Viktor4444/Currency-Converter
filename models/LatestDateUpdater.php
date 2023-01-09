<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Сlass for interacting with the "LatestTablesUpdateDate" table of the database
 *
 * The "LatestTablesUpdateDate" table contains data about when any changes or updates
 * were made to all tables in the database.
 * This class allows you to track and modify the corresponding data.
 *
 * @internal Important note: this class uses database column and table descriptions
 *  whose names use snake case,
 *  so the style of variable names in the code may differ
 *
 * {@inheritdoc}
 * @property int $table_id
 * @property string $table_name
 * @property string $latest_update
 */
class LatestDateUpdater extends ActiveRecord
{
    /**
     * {@inheritdoc}
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // table_name is required
            [['table_name'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     * @static
     * @return string name of table in database
     */
    public static function tableName()
    {
        return '{{%latest_tables_update_date}}';
    }

    /**
     * This method returns the latest update date of the table by its name
     *
     * @static
     * @param  string $tableName table name in database
     * @return string            date the table was last updated
     */
    public static function getLatestUpdateDate($tableName)
    {
        return static::findOne(['table_name' => $tableName])->latest_update;
    }

    /**
     * This method updates the last modified date of the table by its name
     *
     * @static
     * @param string $tableName the name of the table in which the changes were made
     * @param string $newDate [null]   date of the change. if no parameter is passed, sets the current date
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
