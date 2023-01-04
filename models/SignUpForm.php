<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\User;
use app\models\LatestDateUpdater;
 
/**
 * Registration page form
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => User::className()],
        ];
    }

    /**
     * New user registration: entering the username and encrypted password into the database
     *
     * @return User|null the result of an attempt to update the database. If successful, it returns an instance of the User class
     */
    public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);

        if ($user->save()){
            User::setLatestUpdateDate();
            return $user;
        }
        else {
            return null;
        }
    }
}
