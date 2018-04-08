<?php
/* Formulario para modificar imágen de equipo */

use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['equipos/update-imagen', 'id' => $equipo->id]);

$css = <<<EOT
    .error {
        color: #a94442;
    }
EOT;
$js = <<<EOT
    let input_imagen = $('#imagen_equipo');
    let enviar = true;
    let mensaje = $('<div></div>');
    let en_proceso = false;
    mensaje.addClass('error');

    $('#btn-imagen').on('click', function() {
        let num_archivos = input_imagen[0].files.length;
        $('.error').remove();

        if (num_archivos != 0) {
            let archivo = input_imagen[0].files[0];
            console.log(archivo);
            if (archivo.type !== 'image/jpeg') {
                enviar = false;
                mensaje.text('Sólo se permite la extensión jpg.');
                $('div.file-input').after(mensaje);

            } else {
                enviar = true;
                if (!en_proceso) {
                    $('div#img_equipo > img').attr('src', 'images/cargando.gif');
                }

            }

        } else {
            enviar = false;
            mensaje.text('No hay ningún archivo seleccionado.');
            $('div.file-input').after(mensaje);

        }
    });
    $('#form_imagen').on('submit', function(e) {
        console.log(enviar);
        if (enviar && (!en_proceso)) {
            en_proceso = true;
            $.ajax({
                url: '$url',
                type: 'POST',
                enctype: 'multipart/form-data',
                data: new FormData(this),
                success: function (data) {
                    en_proceso = false;
                    $('div#img_equipo > img').attr('src', data);

                },
                dataType: 'json',
                contentType: false,
                processData: false,


            });
        }
        e.preventDefault();

    })
EOT;

$this->registerJs($js);
$this->registerCss($css);
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
                        'options'=>['accept'=>'image/jpg'],
                        'pluginOptions'=>[
                            'showUpload'=>false,
                            'showPreview' => false,
                            'browseIcon'=> '<i class="glyphicon glyphicon-picture"></i>',
                            'browseLabel'=>'Selecciona',
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
