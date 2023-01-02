<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\httpclient\Client;

use app\models\Currency;

class ConverterForm extends Model
{   
    public $firstCurrency;
    public $secondCurrency;
    public $firstSumm;
    public $secondSumm;

    public $currentDate;

    public function init()
    {
        parent::init();
        $this->currentDate = date("Y-m-d H:i:s");
    }

    public function rules()
    {
        return [
          [['firstCurrency', 'secondCurrency', 'currentDate'], 'required' ],
          ['firstSumm', 'required', 'message' => 'Please enter an amount'],
          ['firstSumm', 'number', 'message' => 'Amount must be a number(with dot separator)'],
        ];
    }

    public function checkingForUpdates()
    {
        $currency = Currency::find()->one();
        $needToUpdateExchangeRates = abs(strtotime($currency->dt) - strtotime($this->currentDate)) > Yii::$app->params['TIME_TO_REFRESH'];

        if ($needToUpdateExchangeRates){

            $client = new Client();
            $response = $client->get(Yii::$app->params['DAILY_EXCHANGE_RATES_URL'])->send();

            if ($response->isOk){

                $exchangeRates = $response->getData()['Valute'];

                foreach ($exchangeRates as $exchangeRate){
                    $numCode = $exchangeRate['NumCode'];
                    $value = floatval(str_replace(',', '.', $exchangeRate['Value']));
                    $nominal = floatval(str_replace(',', '.', $exchangeRate['Nominal']));

                    Yii::$app->db->createCommand('UPDATE currency SET Nominal=:nominal, Value=:value WHERE NumCode = :numCode')
                        ->bindValue(':nominal', $nominal)
                        ->bindValue(':numCode', $numCode)
                        ->bindValue(':value', $value)
                        ->execute();
                }
            }
        }
    }

    public function convert()
    {
        $firstCurrencyProperties = Currency::findOne($this->firstCurrency);
        $secondCurrencyProperties = Currency::findOne($this->secondCurrency);
        $this->secondSumm = $this->firstSumm
            * $firstCurrencyProperties['Value']
            * $secondCurrencyProperties['Nominal']
            / $firstCurrencyProperties['Nominal']
            / $secondCurrencyProperties['Value'];
    }
}
