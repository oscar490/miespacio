<?php
/* Renderización del formulario de modificación de tarjeta */

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\dialog\Dialog;


echo Dialog::widget([
    'dialogDefaults' => [
        Dialog::DIALOG_ALERT => [
            'title' => Html::encode('Modificación')
        ]
    ]
]);

$url = Url::to(['tarjetas/update-ajax', 'id' => $model->id]);

$js = <<<EOT
    $("#form_tarjeta_$model->id").on('beforeSubmit', function(e) {
        var form = $(this);

        if (form.find('.has-error').length) {
            return false;
        }

        $.ajax({
            url: '$url',
            type: 'POST',
            data: form.serialize(),
            success: function(data) {
                let div_tarjeta = $("div[data-key='$model->id']");
                let nombre = $('#denominacion').val();
                $("div[data-key='$model->id']  div.modal-body > div.container").html(data);
                $("div[data-key='$model->id']  p.text-left").text(nombre);

                krajeeDialog.alert(
                    'Se han modificado los datos correctamente',
                );


            }
        })



        return false;


    })
EOT;

$this->registerJs($js);
?>
<div class="container">

    <div class='row'>
        <div class='col-md-9'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <?= Html::encode('Tarjeta') ?>
                </div>
                <div class='panel-body'>
                    <?= $this->render('_form', [
                        'model' => $model,
                        'tablero'=>$model->tablero,
                        'label'=>'Modificar',
                        'action'=>['tarjetas/update', 'id'=>$model->id]
                    ]) ?>
                </div>
            </div>
        </div>

    </div>

</div>
