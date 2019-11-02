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

                 $( "#test-lga" ).html( "<option>select Lga</option>" );
                 $( "#test-ward" ).html( "<option>select Ward</option>" );
                 $( "#test-pollingunit" ).html( "<option>select Polling Unit</option>" );

                 $( "#test-lga" ).prop("disabled", true);
                 $( "#test-ward" ).prop("disabled", true);
                 $( "#test-pollingunit" ).prop("disabled", true);

                $.post( "index.php?r=test/state&id='.'"+$(this).val(), function( data ){
                        console.log(data);
                        if(data != ""){
                           $( "#test-lga" ).prop("disabled", false);
                            $( "#test-lga" ).html( data );
                        }          
                   
                });'

            ]

        ); ?>

        <?= $form->field($model, 'lga')->dropdownlist(
            ArrayHelper::map(Lga::find()->all(), 'lga_id', 'lga_name'),
            [
                'prompt'=> 'Select Lga',
                'onchange'=>'

                 $( "#output" ).html( " " );

                $( "#test-ward" ).html( "<option>select Ward</option>" );
                 $( "#test-pollingunit" ).html( "<option>select Polling Unit</option>" );

                 $( "#test-ward" ).prop("disabled", true);
                 $( "#test-pollingunit" ).prop("disabled", true);

                $.post( "index.php?r=test/lga&id='.'"+$(this).val(), function( data ){
                     console.log(data);
                        if(data != ""){
                           $( "#test-ward" ).prop("disabled", false);
                            $( "#test-ward" ).html( data );
                        }

                });'
            ]); ?>

        <?= $form->field($model, 'ward')->dropdownlist(
             ArrayHelper::map(Ward::find()->all(), 'ward_id', 'ward_name'),
            [
                'prompt'=> 'Select ward',
                'onchange'=>'
                    $( "#output" ).html( " " );

                 $( "#test-pollingunit" ).html( "<option>select Polling Unit</option>" );

                 $( "#test-pollingunit" ).prop("disabled", true);

                $.post( "index.php?r=test/ward&id='.'"+$(this).val(), function( data ){
                    console.log(data);
                        if(data != ""){
                           $( "#test-pollingunit" ).prop("disabled", false);
                            $( "#test-pollingunit" ).html( data );
                        }
                       
                });'
            
            ]); ?>
        <?= $form->field($model, 'pollingUnit')->dropdownlist(
             ArrayHelper::map(PollingUnit::find()->all(), 'uniqueid', 'polling_unit_name'),
            [
                'prompt'=> 'select Polling Unit',
                'onchange'=>'
                
                 $( "#output" ).html( `<div class="loader"></div>` );

                $.post( "index.php?r=test/poll&id='.'"+$(this).val(), function( data ){
                    
                    if (data === "" || data === null){
                        $( "#output" ).html( "no data" );
                    }else{
                        $( "#output" ).html( data );
                    }
                    console.log(data);
                    
                    
                });'
            
            ]); ?>

            <div id="output" class="form-group">
            </div>
        
        </div>
    <?php ActiveForm::end(); ?>
                    
    

</div>
<script>
  window.onload = function(e){
         $( "#test-lga" ).prop("disabled", true);
         $( "#test-ward" ).prop("disabled", true);
         $( "#test-pollingunit" ).prop("disabled", true);
    }
</script>