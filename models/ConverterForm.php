<?php

namespace app\models;

use yii\base\Model;
use yii\httpclient\Client;

use app\models\Currency;

/**
 * Main page forms (currency conversion page)
 */
class ConverterForm extends Model
{
    /**
     * String code of the first currency
     * 
     * @var string
     */
    public $firstCurrency;

    /**
     * String code of the second currency
     * 
     * @var string
     */
    public $secondCurrency;

    /**
     * First currency conversion amount
     * 
     * @var string
     */
    public $firstSumm;

    /**
     * Second currency conversion amount
     * 
     * @var float
     */
    public $secondSumm;

    /**
     * @var string
     */
    public $currentDate;

    /**
     * Every time you go to the page, the current date is written to the "currentDate" variable
     * 
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->currentDate = date("Y-m-d");
    }

    /**
     * {@inheritdoc}
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // firstCurrency, secondCurrency and currentDate are required
            [['firstCurrency', 'secondCurrency', 'currentDate'], 'required' ],
            // firstSumm is required
            ['firstSumm', 'required', 'message' => 'Please enter an amount'],
            // firstSumm must be a numeric value
            ['firstSumm', 'number', 'message' => 'Amount must be a number(with dot separator)'],
        ];
    }

    /**
     * Checking the need to update exchange rates
     *
     * The last date of updating the "currency" table is compared with the current date
     * and, if necessary (once a day), the data is updated
     * from the website of the Central Bank of the Russian Federation.
     */
    public function checkingForUpdates()
    {
        $exchangeRatesLatestUpdateDate = Currency::getLatestUpdateDate();
        $needToUpdateExchangeRates = $exchangeRatesLatestUpdateDate != $this->currentDate;

        if ($needToUpdateExchangeRates){

            $client = new Client();
            $response = $client->get(\Yii::$app->params['DAILY_EXCHANGE_RATES_URL'])->send();

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

    /**
     * Function to convert some amount from "firstCurrency" to "secondCurrency"
     *
     * Formula for calculation:
     * the amount entered by the user is multiplied
     * by the exchange rate('Value') from which the conversion takes place
     * and divided by its 'Nominal', then divided by the exchange rate('Value')
     * into which the conversion takes place and multiplied by its 'Nominal'.
     *
     * @todo reconsider the logic and the possibility of moving calculations into the "Currency" class
     * @todo add a divide-by-zero check
     */
    public function convert()
    {
        $firstCurrencyProperties = Currency::findOne($this->firstCurrency);
        $secondCurrencyProperties = Currency::findOne($this->secondCurrency);

        $this->secondSumm = $this->firstSumm
            * $firstCurrencyProperties['value']
            * $secondCurrencyProperties['nominal']
            / $firstCurrencyProperties['nominal']
            / $secondCurrencyProperties['value'];
    }
}
