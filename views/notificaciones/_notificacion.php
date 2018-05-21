<?php
/* Vista de una notificacion */

/* @var $model app\models\Notificaciones */

use yii\helpers\Html;
use app\components\MyHelpers;

$datos = $model->miembro->equipo->usuario->datosUsuarios;

if ($model->tablero_id !== null) {
    $datos = $model->miembro->usuario->datosUsuarios;
}

$contenido = $datos->nombre_completo . ' ' .
    ' ' . $datos->apellidos . ' ' . $model->contenido;
?>

<div class='row'>

    <div class='col-md-12 col-xs-12'>
        <!-- Ávatar de usuario -->
        <div class='col-xs-3 col-md-1'>
            <?=
                Html::img(
                    $datos->url_imagen,
                    ['class'=>'img-circle logo-x2']
                )
            ?>
        </div>

        <!-- Descripción de notificación -->
        <div class='col-xs-9 col-md-10'>
                <strong>
                    <?= $contenido ?>
                </strong>


            <div class='row'>
                <div class='col-md-6'>
                    <?= Yii::$app->formatter->asDateTime($model->created_at) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
