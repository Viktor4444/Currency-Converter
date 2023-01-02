<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\User;
 
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

    public function newUser()
    {
        $user = new User();
        $user->username = $this->username;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);

        Yii::$app->db
            ->createCommand('INSERT user(username, password) VALUES (:username, :password)')
            ->bindValue(':username', $user->username)
            ->bindValue(':password', $user->password)
            ->execute();
    }
}