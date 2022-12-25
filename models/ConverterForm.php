<?php

namespace app\models;

use yii\base\Model;

class ConverterForm extends Model
{   
    public $FirstCurrency;
    public $SecondCurrency;
    public $FirstSumm;
    public $SecondSumm;

    public $current_date;

    public function init(){
        parent::init();
        $this->current_date = date("Y-m-d H:i:s");
    }

    public function rules() {
        return [
          [['FirstCurrency', 'SecondCurrency', 'current_date'], 'required' ],
          ['FirstSumm', 'required', 'message'=>'Please enter an amount'],
          ['FirstSumm', 'number', 'message'=>'Amount must be a number(with dot separator)'],
        ];
    }

}
