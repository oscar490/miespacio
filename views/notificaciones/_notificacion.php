<?php
/* Vista de una notificacion */

/* @var $model app\models\Notificaciones */

use yii\helpers\Html;

$datos = $model->usuario->datosUsuarios;
?>

<div class='row'>

    <div class='col-md-12 col-xs-12'>
        <!-- Ávatar de usuario -->
        <div class='col-xs-3 col-md-1'>
            <?=
                Html::img(
                    $datos->url_imagen,
                    ['class'=>'img-rounded logo-x2']
                )
            ?>
        </div>

        <div class='col-xs-9 col-md-6'>
            <strong>
                <?= $datos->nombre_completo ?>
                <?= $datos->apellidos ?>
                <?= $model->contenido ?>
            </strong>

            <div class='row'>
                <div class='col-md-6'>
                    <?= Yii::$app->formatter->asDateTime($model->created_at) ?>
                </div>
            </div>
        </div>
    </div>
</div>
