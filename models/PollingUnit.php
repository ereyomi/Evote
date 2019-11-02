<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "polling_unit".
 *
 * @property int $uniqueid
 * @property int $polling_unit_id
 * @property int $ward_id
 * @property int $lga_id
 * @property int $uniquewardid
 * @property string $polling_unit_number
 * @property string $polling_unit_name
 * @property string $polling_unit_description
 * @property string $lat
 * @property string $long
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class PollingUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'polling_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['polling_unit_id', 'ward_id', 'lga_id'], 'required'],
            [['polling_unit_id', 'ward_id', 'lga_id', 'uniquewardid'], 'integer'],
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
            'uniqueid' => 'Unique ID',
            'polling_unit_id' => 'Polling Unit ID',
            'ward_id' => 'Ward ID',
            'lga_id' => 'Lga ID',
            'uniquewardid' => 'Unique ward ID',
            'polling_unit_number' => 'Polling Unit Number',
            'polling_unit_name' => 'Polling Unit Name',
            'polling_unit_description' => 'Polling Unit Description',
            'lat' => 'Latitude',
            'long' => 'Longtitude',
            'entered_by_user' => 'Entered By User',
            //'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
        ];
    }
    public function getLga(){
        return $this->hasOne(Lga::className(), ['lga_id' => 'lga_id']);
    }
    
    public function getWard(){
        return $this->hasOne(Ward::className(), ['ward_id' => 'ward_id']);
    }
    
    public function getPollresults(){
        return $this->hasMany(PollResults::className(), ['polling_unit_uniqueid' => 'uniqueid']);
    }
}
