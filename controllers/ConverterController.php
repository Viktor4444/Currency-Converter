<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;
use yii\data\Pagination;
use app\models\ConverterForm;
use app\models\Currency;
use app\models\LoginForm;
use app\models\SignUpForm;
use app\models\User;
use yii\filters\AccessControl;
use yii;



class ConverterController extends Controller
{
	public $layout = 'converter';

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                // 'only' => ['login', 'logout', 'signup'],
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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup(){
	    if (!Yii::$app->user->isGuest) {
	        return $this->goHome();
	    }
	    $model = new SignupForm();
	    if($model->load(\Yii::$app->request->post()) && $model->validate()){
	        $user = new User();
	        $user->username = $model->username;
	        $user->password = \Yii::$app->security->generatePasswordHash($model->password);
	        // echo '<pre>'; var_dump($user->beforeSave(['username' => $user->username])); die;
	        Yii::$app->db->createCommand('INSERT user(username, password) VALUES (:username, :password)')
					->bindValue(':username', $user->username)
					->bindValue(':password', $user->password)
					->execute();
			return $this->goHome();
	    }

    return $this->render('signup', compact('model'));
}

	public function actionIndex()
	{

		$form_model = new ConverterForm();
		$currency = Currency::find()->one();
		
		$need_to_refresh = abs(strtotime($currency->dt) - strtotime($form_model->current_date)) > 86400;

		// var_dump(abs(strtotime($currency->dt) - strtotime($form_model->current_date))); var_dump($need_to_refresh); exit;

		if ($need_to_refresh)
		{
			$client = new Client([

	            'baseUrl' => 'https://www.cbr.ru/scripts/XML_daily.asp',
	            // http://www.cbr.ru/scripts/XML_daily.asp?date_req=02/03/200

	        ]);

			$response = $client->createRequest()
			    ->setMethod('get')
			    ->send();

			if ($response->isOk) {
				$data = $response->getData()['Valute'];
				for ($i = 1; $i < count($data); $i++) {
					$NumCode = $data[$i]['NumCode'];
					$Value = floatval(str_replace(',', '.', $data[$i]['Value']));
					$Nominal = floatval(str_replace(',', '.', $data[$i]['Nominal']));
					// var_dump($Value); exit;
					// $Name = (string)$data[$i]['Name'];
					Yii::$app->db->createCommand('UPDATE currency SET Nominal=:Nominal, Value=:Value WHERE NumCode = :NumCode')
						->bindValue(':Nominal', $Nominal)
						->bindValue(':NumCode', $NumCode)
						->bindValue(':Value', $Value)
						->execute();
				}
			}
		}


		
		if($form_model->load(\Yii::$app->request->post(), 'ConverterForm')) {
			$FirstCurrencyProperties = Currency::findOne( $form_model->FirstCurrency);
			$SecondCurrencyProperties = Currency::findOne($form_model->SecondCurrency);
			$form_model->SecondSumm = $form_model->FirstSumm 
			* $FirstCurrencyProperties['Value'] 
			* $SecondCurrencyProperties['Nominal'] 
			/ $FirstCurrencyProperties['Nominal'] 
			/ $SecondCurrencyProperties['Value'];
		}

		return $this->render('index', compact('form_model'));
	}