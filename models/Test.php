<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * TestForm is the model behind the ereyomi form.
 *
 */
class Test extends Model
{
    public $state;
    public $lga;
    public $ward;
    public $pollingUnit;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            [['state', 'lga', 'ward', 'pollingUnit'], 'required'],
        ];
    }

    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'state' => 'State',
            'Lga' => 'Lga',
            'ward' => 'Ward',
            'pollingUnit' => 'Polling Unit',
        ];
    }

    
}
