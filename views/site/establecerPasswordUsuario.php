<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Restablecer su contraseña de MiEspacio';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <h2>
            <strong>
                <?= $this->title ?>
            </strong>
        </h2>
    </div>
</div>


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
