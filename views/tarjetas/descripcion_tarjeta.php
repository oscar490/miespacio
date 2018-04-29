<?php
/* Contenido de la descripción de la tarjeta */

/* @var $tarjeta app\models\Tarjetas */

use app\components\MyHelpers;
use yii\helpers\Html;

?>

<div id="panel_descri_tarjeta_<?= $tarjeta->id ?>" class='panel panel-default'>

    <!-- Cabecera de descripción -->
    <div class='panel-heading'>
        <strong>
            <?=
                MyHelpers::icon('glyphicon glyphicon-align-left') .
                ' ' . 'Descripción'
            ?>
        </strong>
        <small>
            (click aquí)
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
