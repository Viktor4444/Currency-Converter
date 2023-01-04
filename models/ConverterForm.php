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
        $this->currentDate = date("Y-m-d");
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
        $exchangeRatesLatestUpdateDate = Currency::getLatestUpdateDate();
        $needToUpdateExchangeRates = $exchangeRatesLatestUpdateDate != $this->currentDate;

        if ($needToUpdateExchangeRates){

            $client = new Client();
            $response = $client->get(Yii::$app->params['DAILY_EXCHANGE_RATES_URL'])->send();

            if ($response->isOk){

                $exchangeRates = $response->getData()['Valute'];

                foreach ($exchangeRates as $exchangeRate){
                    $currency = Currency::findOne($exchangeRate['CharCode']);
                    if (!$currency){
                        $currency = new Currency();
                    }
                    $currency->load($exchangeRate, '');
                    $currency->save();
                }
            }
            Currency::setLatestUpdateDate($this->currentDate);
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
