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
    $(document).ready(function() {
        updateImagen('$url', '$equipo->id');
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
                        'id_form'=>"form_imagen_$equipo->id",
                        'id_input'=>"input_img_$equipo->id",
                        'btn_id'=>'btn-imagen',
                        'label'=>'Modificar'
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
