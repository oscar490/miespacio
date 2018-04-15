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
    let input_imagen = $("#$equipo->id");
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

            } else if (archivo.size > 2097152) {
                enviar = false;

                mensaje.text('El tamaño máximo debe ser de 2MB.');
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
    $("#form_imagen_$equipo->id").on('submit', function(e) {
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
                <!-- Formulario de modificado de imagen -->
                <?=
                    $this->render('/site/form_input_file', [
                        'model'=>$equipo,
                        'attribute'=>'imagen_equipo',
                        'showUpload'=>false,
                        'showPreview'=>false,
                        'action'=>'',
                        'id_form'=>$equipo->id,
                        'btn_id'=>'btn-imagen',
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
