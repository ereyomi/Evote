<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Test;
use app\models\States;
use app\models\Lga;
use app\models\Ward;
use app\models\PollingUnit;
/* @var $this yii\web\View */
/* @var $model app\models\Ereyomi */
/* @var $form ActiveForm */
$this->title = 'erepge';
?>
<div class="ereyomi-display">
<h2 class="page-header">Result of each polling unit</h2>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'state')->dropdownlist(
            ArrayHelper::map(States::find()->all(), 'state_id', 'state_name'),
            [
                'prompt'=> 'Select States',
                'onchange'=>'
                
                $( "#output" ).html( " " );

                $.post( "index.php?r=ereyomi/state&id='.'"+$(this).val(), function( data ){
                    if(data === null || data === ""){
                        $( "#ereyomi-lga" ).html( "<option>--</option>" );
                        $( "#ereyomi-ward" ).html( "<option>--</option>" );
                        $( "#ereyomi-pollingunit" ).html( "<option>--</option>" );
                    }else{
                        $( "#ereyomi-lga" ).html( data );
                    }
                    
                });'
            ]

        ); ?>

        <?= $form->field($model, 'lga')->dropdownlist(
            ArrayHelper::map(Lga::find()->all(), 'lga_id', 'lga_name'),
            [
                'prompt'=> 'Select lga',
                'onchange'=>'

                $( "#output" ).html( " " );
                

                $.post( "index.php?r=ereyomi/lga&id='.'"+$(this).val(), function( data ){
                     if(data === null || data === ""){
                        
                        $( "#ereyomi-ward" ).html( "<option>--</option>" );
                        $( "#ereyomi-pollingunit" ).html( "<option>--</option>" );
                        
                    }else{
                        $( "#ereyomi-ward" ).html( data );
                    }
                    
                });'
            ]); ?>

        <?= $form->field($model, 'ward')->dropdownlist(
             ArrayHelper::map(Ward::find()->all(), 'ward_id', 'ward_name'),
            [
                'prompt'=> 'Select ward',
                'onchange'=>'
                    $( "#output" ).html( " " );
                $.post( "index.php?r=ereyomi/ward&id='.'"+$(this).val(), function( data ){
                    
                       $( "#ereyomi-pollingunit" ).html( data );
                });'
            
            ]); ?>
        <?= $form->field($model, 'pollingUnit')->dropdownlist(
             ArrayHelper::map(PollingUnit::find()->all(), 'polling_unit_id', 'polling_unit_name'),
            [
                'prompt'=> 'Select Polling  Unit',
                'onchange'=>'
                $( "#output" ).html( " " );

                $.post( "index.php?r=ereyomi/poll&id='.'"+$(this).val(), function( data ){
                    $( "#output" ).html( data );
                    console.log(data);
                });'
            
            ]); ?>
            <div id="output" class="form-group">
            </div>
        
        </div>
    <?php ActiveForm::end(); ?>
                    
    

</div><!-- ereyomi-display -->
