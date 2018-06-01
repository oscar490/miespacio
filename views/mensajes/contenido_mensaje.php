<?php
/* Contenido de un mensaje */

/* @var $mensaje app\models\Mensajes */
use yii\helpers\Html;
use app\components\MyHelpers;

?>

<div class='row'>
    <div class='col-md-12'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <strong>
                    <?= Html::encode($mensaje->asunto) ?>
                </strong>
            </div>

            <div class='panel-body'>
                <?= Html::encode($mensaje->contenido) ?>
            </div>
        </div>
    </div>
</div>
