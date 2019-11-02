<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * TestForm is the model behind the ereyomi form.
 *
 */
class Addpoll extends Model
{
    public $uniqueid;
    public $polling_unit_id;
    public $state;
    public $lga_id;
    public $ward_id;
    
    public $uniquewardid;
    public $polling_unit_number;
    public $polling_unit_name;
    public $polling_unit_description;
    public $lat;
    public $long;

    public $resultid;
    public $polling_unit_uniqueid;
    public $party_abbreviation;
    public $party_score;

    public $entered_by_user;
    public $date_entered;
    public $user_ip_address;

    


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['polling_unit_id', 'polling_unit_uniqueid', 'party_abbreviation', 'party_score', 'ward_id', 'lga_id', 'state'], 'required'],
            [['polling_unit_id'], 'unique'],
            [['polling_unit_id', 'ward_id', 'lga_id', 'uniquewardid', 'polling_unit_uniqueid', 'party_score'], 'integer'],
            [['polling_unit_description'], 'string'],
            [['date_entered'], 'safe'],
            [['polling_unit_number', 'polling_unit_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
            [['lat', 'long'], 'string', 'max' => 255],
        ];
    }

    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'polling_unit_id' => 'Polling Unit ID',
            'state' => 'State',
            'lga_id' => 'Lga',
            'ward_id' => 'Ward',
            
            'uniquewardid' => 'Unique ward ID',
            'polling_unit_number' => 'Polling Unit Number',
            'polling_unit_name' => 'Polling Unit Name',
            'polling_unit_description' => 'Polling Unit Description',
            'lat' => 'Latitude',
            'long' => 'Longtitude',
            'entered_by_user' => 'Entered By User',

            'polling_unit_uniqueid' => 'Polling Unit Uniqueid',
            'party_abbreviation' => 'Party',
            'party_score' => 'party Score',
        ];
    }

    
}
