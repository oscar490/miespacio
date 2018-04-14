<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class='row'>
    <div class='col-md-3'>
        <div class='panel panel-default'>
            <div class='panel-heading'>

            </div>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin([
                    'action'=>['subidas/create'],
                ]) ?>
                    <?= $form->field($model, 'nombre') ?>

                    <?= $form->field($model, 'url_direccion') ?>

                    <?= Html::hiddenInput('tarjeta_id', $tarjeta->id) ?>

                    <?= Html::submitButton(
                            'enviar',
                            ['class'=>'btn btn-default btn-block']
                        );
                    ?>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
