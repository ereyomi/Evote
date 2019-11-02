<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * TestForm is the model behind the ereyomi form.
 *
 */
class Add_new_poll extends Model
{
    public $polling_unit_id ;
    public $ward_id;
    public $lga_id;
    public $uniquewardid;
    public $polling_unit_number;
    public $polling_unit_name;
    public $polling_unit_description;
    public $pollingUnit;
    public $lat;
    public $long;
    public $entered_by_user;
    public $date_entered;    
    public $user_ip_address;

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
