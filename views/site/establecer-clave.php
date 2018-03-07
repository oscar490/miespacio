<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>


<?php $form = ActiveForm::begin() ?>

    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <?= Html::submitButton('Enviar', ['class'=>'btn btn-success'])?>
        </div>
    </div>


<?php ActiveForm::end() ?>
