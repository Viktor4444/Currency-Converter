<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

use app\models\LoginForm;
use app\models\SignUpForm;
use app\models\ConverterForm;

class ConverterController extends Controller
{
	public $layout = 'converter';

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
        $loginFormModel = new LoginForm();
        if ($loginFormModel->load(Yii::$app->request->post()) && $loginFormModel->login()) {
            return $this->goBack();
        }

        return $this->render(
            'login', ['model' => $loginFormModel]
        );
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
	    $signupFormModel = new SignupForm();

	    if ($signupFormModel->load(\Yii::$app->request->post()) && $signupFormModel->validate()){
	        $signupFormModel->newUser();
	        return $this->goHome();
	    }

    return $this->render('signup', compact('signupFormModel'));
    }

	public function actionIndex()
	{
		$converterFormModel = new ConverterForm();
		$converterFormModel->checkingForUpdates();

		if($converterFormModel->load(\Yii::$app->request->post(), 'ConverterForm')) {
			$converterFormModel->convert();
		}

		return $this->render('index', compact('converterFormModel'));
	}
}
