<?php

namespace app\models;

use yii\db\ActiveRecord;

class Currency extends ActiveRecord
{	
	public function rules() {
        return 
        [
          [['CharCode', 'Name', 'Nominal', 'Value', 'NumCode'], 'required' ],
        ];
    }
}