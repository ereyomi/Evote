<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\States;

class StatesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = States::find();


        $pagination = new Pagination([
                'defaultPageSize' => 36,
                'totalCount' => $query->count(),
        ]);

        $states = $query->orderBy('state_id')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

       //Render view
        return $this->render('index', [
            'states' => $states,
            'pagination' => $pagination,
        ]);
    }
    public function actionLgapage($id){
        //get lgas
        $state = States::find()
        ->where(['state_id' => $id])
        ->one();

        //Render View
        return $this->render('lgapage', ['state'=> $state]);
    }
     public function actionForm()
     {
        $states = new States();
        return $this->render('form', ['states'=>$states]);
    }
    

}
