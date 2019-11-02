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
$this->title = 'local Result';
?>
<div class="ereyomi-display">

<h2 class="page-header">Result of each Local government</h2>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'state')->dropdownlist(
            ArrayHelper::map(States::find()->all(), 'state_id', 'state_name'),
            [
                'prompt'=> 'Select States',
                'onchange'=>'
                
                $( "#output" ).html( " " );
                $( "#test-lga" ).html( " " );
                $( "#test-lga" ).prop("disabled", true);

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
                'prompt'=> 'Select Local government',
                'onchange'=>'

                  $( "#outputit" ).html( `<div class="loader"></div>` );

                $.post( "index.php?r=test/totalpoll&id='.'"+$(this).val(), function( data ){
                      
                        console.log(data);
                        if(data == ""){
                            $( "#outputit" ).html( "no data");
                            console.log("its empty");
                        }else{
                            $( "#outputit" ).html( data );
                        }   
                    
                });'
            ]); ?>

        
            <div id="outputit" class="form-group">
            </div>
        
        </div>
    <?php ActiveForm::end(); ?>
                    
    

</div><!-- ereyomi-display -->
<script>
  window.onload = function(e){
         $( "#test-lga" ).prop("disabled", true);
    }
</script>