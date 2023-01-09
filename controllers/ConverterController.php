<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

use app\models\LoginForm;
use app\models\SignUpForm;
use app\models\ConverterForm;

/**
 * Main conversion site controller
 */
class ConverterController extends Controller
{
	/**
	 * @link https://www.yiiframework.com/doc/api/2.0/yii-base-controller#$layout-detail Documentation of $layout
	 * @var  string|null|false
	 */
	public $layout = 'converter';

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $loginFormModel = new LoginForm();
        if ($loginFormModel->load(Yii::$app->request->post()) && $loginFormModel->login()){
            return $this->goBack();
        }

        return $this->render('login', compact('loginFormModel'));
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Signup action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
	    $signupFormModel = new SignupForm();

	    if ($signupFormModel->load(Yii::$app->request->post()) && $signupFormModel->validate()){
	        if ($user = $signupFormModel->signup()){
	            if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
	    }

    return $this->render('signup', compact('signupFormModel'));
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
	public function actionIndex()
	{
		$converterFormModel = new ConverterForm();
		$converterFormModel->checkForUpdates();

		if($converterFormModel->load(Yii::$app->request->post(), 'ConverterForm')){
			$converterFormModel->convert();
		}

		return $this->render('index', compact('converterFormModel'));
	}
}
