<?php

namespace app\models;

use Yii;
use yii\helpers\Security;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use app\models\LatestDateUpdater;

/**
 * Standard yii2 framework class for authorization
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $authKey;
    public $accessToken;

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Getting the latest update/change time of the "user" table
     *
     * @static
     * @return data
     */
    public static function getLatestUpdateDate()
    {
        return LatestDateUpdater::getLatestUpdateDate(self::getTableSchema()->fullName);
    }

    /**
     * Setting the latest update/change time of the "user" table
     * @static
     */
    public static function setLatestUpdateDate()
    {
        LatestDateUpdater::setLatestUpdateDate(self::getTableSchema()->fullName);
    }
}
