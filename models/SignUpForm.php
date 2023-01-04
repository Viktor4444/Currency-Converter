<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\User;
use app\models\LatestDateUpdater;
 
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
