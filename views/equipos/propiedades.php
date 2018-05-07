<?php
/* Vista de propiedades del equipo, como la imagen y el titulo */

/* @var $model app\models\Equipos */
use yii\helpers\Html;
use app\components\MyHelpers;


//  JavaScript: Después de cargar el documento completamente, se cambia la
//  imagen del equipo.
$js = <<<EOT
    $(document).ready(function() {
        selector = $('#img_equipo img');
        imagen = '$model->url_imagen';

        cambiarImagen(imagen, selector);
    })
EOT;

$this->registerJs($js);

?>

<div class='row centrado'>

    <!-- Imágen del equipo -->
    <div id='img_equipo' class='col-xs-4 col-sm-1 col-md-1 col-lg-1'>
        <?=
            Html::img(
                'images/cargando.gif',
                ['class'=>'img-circle']
            );
        ?>
    </div>

    <!-- Título del nombre del equipo -->
    <div id='titulo' class='col-xs-8 col-sm-11 col-md-11 col-lg-11'>
        <h3>
            <strong>
                <?= Html::encode($model->denominacion) ?>
            </strong>
        </h3>
        <div class='row'>

            <!-- Descripción del equipo -->
            <div class='col-md-4'>
                <p>
                    <?= Html::encode($model->descripcion) ?>
                </p>
            </div>
        </div>
    </div>
</div>
