<?php
/* Vista de un tablero encontrado */

/* @var $model app\models\Tableros */

use yii\helpers\Html;
?>

<div class='row'>
    <div class='col-md-3'>
        <strong>
            <?= Html::encode($model->denominacion) ?>
        </strong>

        <div class='row'>
            <div class='col-md-3'>
                <?= Html::encode($model->equipo->denominacion) ?>
            </div>
        </div>
    </div>
</div>
