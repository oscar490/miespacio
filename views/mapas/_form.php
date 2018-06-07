<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Mapas */
/* @var $form yii\widgets\ActiveForm */

$js = <<<EOT
    $("#form_map").on('beforeSubmit', function() {
        let form = $(this);




        return false;
    })
EOT;

$this->registerJs($js);
?>

<div class="mapas-form">

    <?php $form = ActiveForm::begin([
        'id'=>'form_map'
    ]); ?>

    <?= $form->field($model, 'ubicacion')->textInput([
        'maxlength' => true,
        'id'=>"pac-input",
        ])->label(false) ?>

    <?= $form->field($model, 'latitud')->textInput()->hiddenInput()
        ->label(false) ?>

    <?= $form->field($model, 'longitud')->textInput()->hiddenInput()
        ->label(false) ?>

    <?= Html::hiddenInput('tarjeta_id', $tarjeta->id) ?>

    

    <?php ActiveForm::end(); ?>

</div>
