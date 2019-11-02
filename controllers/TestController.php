<?php

namespace app\controllers;
use yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Test;
use app\models\States;
use app\models\Lga;
use app\models\Ward;
use app\models\PollingUnit;
use app\models\PollResults;
use app\models\Party;


class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Test();

        return $this->render('index', [ 
            'model' => $model, 
        ]);
    }
    
    public function actionLocalresult()
    {
       $model = new Test();


        return $this->render('localresult', [
            'model' => $model,
        ]);
    }

    public function actionAddpoll()
    {
        $model = new Addpoll();
        
    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            return;
        }
    }

    return $this->render('addpoll', [
        'model' => $model,
    ]);
    }

    
    public function actionState($id){
        $countStates = States::find()->where(['state_id' => $id])->count();
        $state = States::find()->where(['state_id' => $id])->one();

        if($countStates > 0){
            
             foreach($state->lga as $lga){
                
               echo "<option value='".$lga->lga_id."'>". $lga->lga_name."</option>";
             }
        }else{
             return '';
        }
    }

    public function actionLga($id){
        $countlga = Lga::find()->where(['lga_id' => $id])->count();
        $lga = Lga::find()->where(['lga_id' => $id])->one();


        if($countlga > 0){
             foreach($lga->ward as $ward){
                
               echo "<option value='".$ward->ward_id."'>". $ward->ward_name."</option>";
               
             }
        }else{
            return '';
        }
    }
    public function actionWard($id){
        $countWard = Ward::find()->where(['ward_id' => $id])->count();
        $Ward = Ward::find()->where(['ward_id' => $id])->one();

        if($countWard > 0){
             foreach($Ward->pollingunit as $poll){
               echo "<option value='".$poll->uniqueid."'>".$poll->polling_unit_name."</option>";               
             }
        }else{
            return '';
        }
    }
    public function actionPoll($id){

       $countpoll = PollingUnit::find()->where(['uniqueid' => $id])->count();
       $pollingunit= PollingUnit::find()->where(['uniqueid' => $id])->one();
       #var_dump($pollingunit->pollresults);
       $output = '';
       
       if($countpoll > 0){
             foreach($pollingunit->pollresults as $pollresult){
               $output .= "<p value='".$pollresult->polling_unit_uniqueid."'>".$pollresult->party_abbreviation." - ".$pollresult->party_score."</p>";
               
             }
             return $output;
        }else{
            return "no data";
        }
    }

    public function actionTotalpoll($id) {
        $LgaQuery = Lga::find()->where(['lga_id' => $id])->one();
        //var_dump($LgaQuery);        
        $id = [];
        //$idme = [8, 9];
        foreach ($LgaQuery->pollingunitt as $key => $value) {
            $id[] = $value['uniqueid'];
        }
        //var_dump($id);
        //$ids = implode(',', $id);
        //echo $ids."<br>";
        
        $Query = PollResults::find()->asArray()->select(['party_abbreviation', 'SUM(party_score)'])->where(['IN', 'polling_unit_uniqueid', $id])->groupBy(['party_abbreviation'])->all();
        //var_dump($finalQuery);
        foreach ($Query as $key => $value) {
           echo $value['party_abbreviation']." - ".$value['SUM(party_score)']."<br>";
        }
    }

    /*public function actionNew() {
        $queryID = Lga::find()->all();
        
        $ids = [];
        foreach ($queryID as $i => $model) {
            $ids[] = $model['lga_id'];
        }
        //var_dump($ids);

        //echo implode(',', $ids);

        $command = Yii::$app->db->createCommand('select SUM(lga_id) FROM ward WHERE `lga_id` IN ('.implode(',',$ids).')');
            $sum = $command->queryScalar();
            echo $sum;
         //$command = Yii::$app->db->createCommand('sum party_abbreviation, SUM(party_score) announced_pu_results WHERE polling_unit_uniqueid IN ('.implode(',',$id).') GROUP BY party_abbreviation');

    }*/

}
