<?php
/* Formulario para modificar imágen de equipo */

use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['equipos/update-imagen', 'id' => $equipo->id]);
$js = <<<EOT

    $('#btn-imagen').on('click', function() {
        $('div#img_equipo > img').attr('src', 'images/cargando.gif');
    });
    $('#form_imagen').on('submit', function(e) {

        $.ajax({
            url: '$url',
            type: 'POST',
            enctype: 'multipart/form-data',
            data: new FormData(this),
            success: function (data) {
                $('div#img_equipo > img').attr('src', data);

            },
            dataType: 'json',
            contentType: false,
            processData: false,


        });
        e.preventDefault();

    })
EOT;

$this->registerJs($js);
?>
<br>
<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?=
                    Html::tag(
                        'p',
                        Html::tag(
                            'span',
                            '',
                            ['class'=>'glyphicon glyphicon-picture']
                        ) . ' ' . Html::encode('Imágen de equipo')
                    );
                ?>
            </div>
            <div class='panel-body'>
                <?php $form = ActiveForm::begin([
                    'id'=>'form_imagen',
                ]) ?>

                    <?= $form->field($equipo, 'imagen_equipo')->widget(FileInput::className(), [
                        'options'=>['accept'=>'image/*'],
                        'pluginOptions'=>[
                            'showUpload'=>false,
                            'showPreview' => false,
                            'browseIcon'=> '<i class="glyphicon glyphicon-picture"></i>',
                        ],
                    ]);
                    ?>

                    <?= Html::submitButton('Cambiar imágen',[
                            'class'=>'btn btn-success btn-block',
                            'id'=>'btn-imagen'
                        ])
                    ?>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
