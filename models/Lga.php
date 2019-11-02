<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lga".
 *
 * @property int $uniqueid
 * @property int $lga_id
 * @property string $lga_name
 * @property int $state_id
 * @property string $lga_description
 * @property string $entered_by_user
 * @property string $date_entered
 * @property string $user_ip_address
 */
class Lga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lga_id', 'lga_name', 'state_id', 'entered_by_user', 'date_entered', 'user_ip_address'], 'required'],
            [['lga_id', 'state_id'], 'integer'],
            [['lga_description'], 'string'],
            [['date_entered'], 'safe'],
            [['lga_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uniqueid' => 'Uniqueid',
            'lga_id' => 'Lga ID',
            'lga_name' => 'Lga Name',
            'state_id' => 'State ID',
            'lga_description' => 'Lga Description',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User Ip Address',
        ];
    }
    public function getState(){
        return $this->hasOne(States::className(), ['state_id' => 'state_id']);
    }
    public function getWard(){
        return $this->hasMany(Ward::className(), ['lga_id' => 'lga_id']);
    }

    public function getPollingunitt(){
        return $this->hasMany(PollingUnit::className(), ['lga_id' => 'lga_id']);
    }

     public function getFromlocal()
    {
        return $this->hasMany(Ward::className(), ['lga_id' => 'lga_id'])
                    ->viaTable('polling_unit', ['lga_id' => 'lga_id']);
    }

   /*public function getSum()
    {
        $total = (new \yii\db\Query())
        ->select('SUM(st_hours) + SUM(ot_hours) + SUM(dt_hours) + SUM(travel_time_hours)')
        ->from(PollingUnit::tableName())
        ->where(['type' => $type])
        ->scalar();
    }

    public function getSum()
    {
        $total = (new \yii\db\Query())
        ->select('SUM(party_score)')
        ->from(PollResults::tableName())
        ->where(['party_abbreviation' => 'PDP'])
        ->scalar();
    }*/
}
