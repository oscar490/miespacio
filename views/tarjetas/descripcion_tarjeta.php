<?php
/* Contenido de la descripción de la tarjeta */

/* @var $tarjeta app\models\Tarjetas */

use app\components\MyHelpers;
use yii\helpers\Html;

$js = <<<EOT
    $(document).ready(function() {
        $(`#header_titulo_tarjeta_$tarjeta->id`).on('click', function() {
                $(this).next().next().slideToggle();
        })
    })
EOT;

$this->registerJs($js);

?>

<!-- Título de la tarjeta -->
<div class='row'>
    <div class='col-xs-12 col-md-10 titulo'>
        <h4>
            <strong>
                <?= Html::encode($tarjeta->denominacion) ?>
            </strong>
            <small>
                en lista
                <?=
                    Html::encode($tarjeta->lista->denominacion)
                ?>
            </small>
        </h4>
    </div>

    <!-- Botón de ocultar tarjeta -->
    <div class='col-xs-12 col-md-2'>
        <?= $this->render('button_ocultar_tarjeta', [
            'tarjeta'=>$tarjeta,
        ]) ?>

    </div>
</div>

<div class='row'>
    <div class='col-md-12'>
        <div class='panel panel-default'>

            <!-- Cabecera de descripción -->
            <div id="header_titulo_tarjeta_<?=$tarjeta->id?>"class='panel-heading'>
                <strong>
                    <?=
                        MyHelpers::icon('glyphicon glyphicon-align-left') .
                        ' ' . 'Descripción'
                    ?>
                </strong>
                <small>
                    (click aquí para modificar el nombre y la descripción)
                </small>
            </div>

            <!-- Texto de descripción de la tarjeta -->
            <div class='panel-body'>
                <?php if (!$tarjeta->contieneDescripcion): ?>
                    <p>
                        Selecciona sobre <strong>Descripción</strong> para
                        añadir una descripción en la tarjeta ó para cambiar
                        el nombre de la tarjeta.
                    </p>

                <?php else: ?>
                    <?= Html::encode($tarjeta->descripcion) ?>

                <?php endif; ?>
            </div>

            <!-- Formulario de modificación de tarjeta -->
            <div id="div_update_tarjeta_<?= $tarjeta->id ?>" class='panel-footer'>
                <?= $this->render('update', [
                    'model'=>$tarjeta
                ]) ?>
            </div>
        </div>



    </div>
</div>
