<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\States;
use app\models\Lga;
use app\models\Ward;
use app\models\PollingUnit;

/* @var $this yii\web\View */
/* @var $states app\models\States */
/* @var $form ActiveForm */
?>
<div class="states-form">

    <?php $form = ActiveForm::begin(); ?>

       
        <?= $form->field($states, 'state_name')->dropdownlist(
            ArrayHelper::map(States::find()->all(), 'state_id', 'state_name'),
            [
                'prompt'=> 'Select States',
                'onchange'=>'
                $.post( "index.php?r=states/list&id='.'"+$(this).val(), function( data ){
                    $( "#displayLGA" ).html( data );
                });'
            ]

        );?>
        <div class="form-group">
        
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
        <select id="displayLGA" style="background: tomato; width:300px;; color:white" class="form-control">
        
        </select>
</div><!-- states-form -->
